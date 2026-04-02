<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Iklan;
use Illuminate\Http\Request;

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
        
        // Latest news for the ticker
        $related_news = Berita::where('status', 'published')->where('id', '!=', $berita->id)->latest()->take(3)->get();
        
        $trending_keywords = ['Pemilu 2024', 'Mudik Lebaran', 'Artificial Intelligence', 'Timnas Indonesia', 'Inovasi Digital', 'Gaya Hidup Sehat'];

        return view('news.show', compact('berita', 'ads', 'related_news', 'trending_keywords'));
    }
}
