<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Iklan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the portal homepage.
     */
    public function index()
    {
        // Get published news
        $latest_news = Berita::where('status', 'published')->with('user')->latest()->take(5)->get();
        $all_news = Berita::where('status', 'published')->with('user')->latest()->paginate(10);
        
        // Get active advertisements
        $raw_ads = Iklan::active()->get();
        $ads = [
            'top_leaderboard' => $raw_ads->where('position', 'top_leaderboard')->first(),
            'sidebar_square' => $raw_ads->where('position', 'sidebar_square')->first(),
            'in_feed' => $raw_ads->where('position', 'in_feed_native')->first(),
            'wallpaper' => $raw_ads->where('position', 'wallpaper')->first(),
        ];

        // Mock categories for Detik-style sections
        $categories = [
            'Nasional' => Berita::where('status', 'published')->latest()->take(3)->get(),
            'Teknologi' => Berita::where('status', 'published')->latest()->skip(3)->take(3)->get(),
            'Ekonomi' => Berita::where('status', 'published')->latest()->skip(6)->take(3)->get(),
        ];
        // Mock Trending Keywords
        $trending_keywords = ['Pemilu 2024', 'Mudik Lebaran', 'Artificial Intelligence', 'Timnas Indonesia', 'Inovasi Digital', 'Gaya Hidup Sehat'];
        
        return view('welcome', compact('latest_news', 'all_news', 'ads', 'categories', 'trending_keywords'));
    }
}
