<?php

namespace App\Jobs;

use App\Models\Berita;
use App\Services\GeminiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateSummaryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $beritaId;

    /**
     * Create a new job instance.
     */
    public function __construct($beritaId)
    {
        $this->beritaId = $beritaId;
    }

    /**
     * Execute the job.
     */
    public function handle(GeminiService $gemini): void
    {
        $berita = Berita::find($this->beritaId);
        
        if (!$berita) {
            Log::error("GenerateSummaryJob: Berita not found [ID: {$this->beritaId}]");
            return;
        }

        Log::info("Generating summary for: {$berita->title}");
        
        $summary = $gemini->generateSummary(strip_tags($berita->content));
        
        if ($summary) {
            $berita->update(['summary' => $summary]);
            Log::info("Summary generated successfully for: {$berita->title}");
        } else {
            Log::warning("Summary generation failed for: {$berita->title}");
        }
    }
}
