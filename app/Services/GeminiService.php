<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    /**
     * Generate a concise summary for a news article.
     */
    public function generateSummary(string $content): ?string
    {
        if (!$this->apiKey || $this->apiKey === 'MOCK_KEY') {
            return $this->mockSummary($content);
        }

        try {
            $response = Http::post("{$this->apiUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Ringkas berita berikut dalam 3-4 kalimat padat dalam bahasa Indonesia: \n\n" . $content]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            }

            Log::error('Gemini API Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Fallback mock summary for development.
     */
    protected function mockSummary(string $content): string
    {
        // Simple logic to create a "mock" summary from the first few sentences
        $sentences = preg_split('/(?<=[.?!])\s+/', strip_tags($content), 3);
        $summary = implode(' ', array_slice($sentences, 0, 2));
        
        return " [PRO AI SUMMARY]: " . $summary . "... (Hubungkan API Gemini untuk ringkasan real-time)";
    }
}
