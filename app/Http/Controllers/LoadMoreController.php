<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class LoadMoreController extends Controller
{
    /**
     * Load more news articles via AJAX.
     */
    public function index(Request $request)
    {
        $skip = $request->input('skip', 0);
        $take = 10;

        $news_list = Berita::where('status', 'published')
            ->with('user')
            ->latest()
            ->skip($skip)
            ->take($take)
            ->get();

        if ($news_list->isEmpty()) {
            return response()->json(['html' => '', 'hasMore' => false]);
        }

        $html = '';
        foreach ($news_list as $news) {
            // Using a partial-like string for simplicity in this demo
            $html .= view('partials.news_card', compact('news'))->render();
        }

        return response()->json([
            'html' => $html,
            'hasMore' => $news_list->count() === $take
        ]);
    }
}
