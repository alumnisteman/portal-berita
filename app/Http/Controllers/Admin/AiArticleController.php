<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class AiArticleController extends Controller
{
    /**
     * Show AI article generator form.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.ai-article', compact('categories'));
    }

    /**
     * Generate article content via Gemini AI.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'keywords' => 'nullable|string',
            'style' => 'required|in:berita,how-to,review,listicle',
            'length' => 'required|in:short,medium,long',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $topic = $request->topic;
        $keywords = $request->keywords;
        $style = $request->style;
        $wordCount = $request->length === 'short' ? 400 : ($request->length === 'medium' ? 800 : 1200);

        $styleGuide = [
            'berita' => 'Tulis sebagai artikel berita faktual gaya jurnalistik Indonesia. Gunakan 5W1H. Paragraf pendek.',
            'how-to' => 'Tulis sebagai artikel panduan langkah demi langkah. Mulai dengan problem, lanjut dengan solusi terstruktur.',
            'review' => 'Tulis sebagai review mendalam dengan kelebihan, kekurangan, dan kesimpulan/verdict di akhir.',
            'listicle' => 'Tulis sebagai artikel daftar (Top N). Setiap poin harus punya penjelasan minimal 2 kalimat.',
        ];

        $prompt = "Kamu adalah jurnalis profesional Indonesia. " . $styleGuide[$style] . "\n\n"
            . "Topik: {$topic}\n"
            . ($keywords ? "Keywords yang wajib dimasukkan secara alami: {$keywords}\n" : "")
            . "Target panjang artikel: {$wordCount} kata.\n\n"
            . "Format output:\n"
            . "JUDUL: [judul artikel yang menarik dan SEO-friendly]\n"
            . "ISI:\n[isi artikel lengkap dengan paragraf yang dipisah oleh baris kosong]\n\n"
            . "Tulis dalam Bahasa Indonesia yang baik dan natural. Jangan gunakan markdown (bold, italic, header). Hanya teks biasa.";

        try {
            $apiKey = config('services.gemini.key');
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['temperature' => 0.7, 'maxOutputTokens' => 4096],
                ]);

            if ($response->failed()) {
                return back()->withErrors(['error' => 'Gagal menghubungi AI. Periksa API key Gemini Anda.'])->withInput();
            }

            $text = $response->json('candidates.0.content.parts.0.text');
            
            // Parse the generated text
            preg_match('/JUDUL:\s*(.+)/i', $text, $titleMatch);
            preg_match('/ISI:\s*([\s\S]+)/i', $text, $contentMatch);

            $title = trim($titleMatch[1] ?? $topic);
            $content = trim($contentMatch[1] ?? $text);

            return back()->with([
                'generated_title' => $title,
                'generated_content' => $content,
                'category_id' => $request->category_id,
            ])->withInput();

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Save generated article to database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published',
        ]);

        $berita = Berita::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Artikel AI berhasil disimpan!');
    }
}
