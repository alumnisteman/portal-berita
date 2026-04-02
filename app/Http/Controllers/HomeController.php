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
        $latest_news = Berita::where('status', 'published')->with(['user', 'category'])->latest()->take(5)->get();
        $all_news = Berita::where('status', 'published')->with(['user', 'category'])->latest()->paginate(10);
        
        // Get active advertisements
        $raw_ads = Iklan::active()->get();
        $ads = [
            'top_leaderboard' => $raw_ads->where('position', 'top_leaderboard')->first(),
            'sidebar_square' => $raw_ads->where('position', 'sidebar_square')->first(),
            'in_feed' => $raw_ads->where('position', 'in_feed_native')->first(),
            'wallpaper' => $raw_ads->where('position', 'wallpaper')->first(),
        ];

        // Fetch real categories and their latest news
        $categories_raw = \App\Models\Category::whereHas('beritas', function($q) {
            $q->where('status', 'published');
        })->take(4)->get();

        $categories = [];
        foreach ($categories_raw as $cat) {
            $categories[$cat->name] = Berita::where('status', 'published')
                ->where('category_id', $cat->id)
                ->latest()
                ->take(3)
                ->get();
        }

        // Mock Trending Keywords
        $trending_keywords = ['Pemilu 2024', 'Mudik Lebaran', 'Artificial Intelligence', 'Timnas Indonesia', 'Inovasi Digital', 'Gaya Hidup Sehat'];
        
        return view('welcome', compact('latest_news', 'all_news', 'ads', 'categories', 'trending_keywords'));
    }
}
