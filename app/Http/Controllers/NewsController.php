<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Show the full news article details.
     */
    public function show(Berita $berita)
    {
        // Track views
        $berita->increment('views');

        // Ad slots for article page
        $raw_ads = Iklan::active()->get();
        $ads = [
            'top_leaderboard' => $raw_ads->where('position', 'top_leaderboard')->first(),
            'sidebar_square' => $raw_ads->where('position', 'sidebar_square')->first(),
            'article_interruption' => $raw_ads->where('position', 'article_interruption')->first(),
        ];
        
        // Related & latest news
        $related_news = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(6)
            ->get();
        
        // Auto Internal Linking: find other articles whose titles appear in this article's content
        $all_other_news = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->select('id', 'title', 'slug')
            ->latest()
            ->take(20)
            ->get();

        $linkedContent = $berita->content;
        $linkedCount = 0;
        foreach ($all_other_news as $other) {
            if ($linkedCount >= 5) break; // max 5 internal links
            $searchTerm = Str::limit($other->title, 50, '');
            // Find first 3+ word sequence that appears in content
            $words = explode(' ', $other->title);
            if (count($words) >= 3) {
                $phrase = implode(' ', array_slice($words, 0, min(4, count($words))));
                if (stripos($linkedContent, $phrase) !== false) {
                    $link = '<a href="' . route('news.show', $other->slug) . '" class="text-primary fw-semibold text-decoration-underline" style="text-decoration-style: dotted;">' . $phrase . '</a>';
                    $linkedContent = str_ireplace($phrase, $link, $linkedContent);
                    $linkedCount++;
                }
            }
        }
        $berita->linked_content = $linkedContent;

        $trending_keywords = ['Pemilu 2024', 'Mudik Lebaran', 'Artificial Intelligence', 'Timnas Indonesia', 'Inovasi Digital', 'Gaya Hidup Sehat'];

        return view('news.show', compact('berita', 'ads', 'related_news', 'trending_keywords'));
    }

    /**
     * Display news by category.
     */
    public function category(Category $category)
    {
        $all_news = Berita::where('status', 'published')
            ->where('category_id', $category->id)
            ->with(['user', 'category'])
            ->latest()
            ->paginate(12);
        
        $trending_keywords = ['Pemilu 2024', 'Mudik Lebaran', 'Artificial Intelligence', 'Timnas Indonesia', 'Inovasi Digital', 'Gaya Hidup Sehat'];
        
        // Get active advertisements
        $raw_ads = Iklan::active()->get();
        $ads = [
            'sidebar_square' => $raw_ads->where('position', 'sidebar_square')->first(),
        ];

        return view('welcome', [
            'latest_news' => collect(), // Empty hero for category pages
            'all_news' => $all_news,
            'ads' => $ads,
            'categories' => [], // Hide category blocks on category page
            'trending_keywords' => $trending_keywords,
            'category_title' => $category->name
        ]);
    }
}
