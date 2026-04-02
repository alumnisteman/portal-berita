<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IklanController extends Controller
{
    public function index()
    {
        $iklans = Iklan::latest()->paginate(10);
        return view('admin.iklan.index', compact('iklans'));
    }

    public function create()
    {
        $positions = [
            'top_leaderboard' => 'Top Leaderboard (Banner Atas)',
            'sidebar_square' => 'Sidebar Square (Kotak Samping)',
            'in_feed_native' => 'In-Feed Native (Antara Berita)',
            'article_interruption' => 'Article Interruption (Dalam Berita)',
            'interstitial' => 'Interstitial (Pop-up/Overlay)',
            'wallpaper' => 'Wallpaper (Background Desktop)'
        ];
        return view('admin.iklan.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'url_link' => 'nullable|url',
            'position' => 'required|in:top_leaderboard,sidebar_square,in_feed_native,article_interruption,interstitial,wallpaper',
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date',
        ]);

        $imagePath = $request->file('image')->store('iklans', 'public');

        Iklan::create([
            'title' => $request->title,
            'image_path' => $imagePath,
            'url_link' => $request->url_link,
            'position' => $request->position,
            'is_active' => $request->has('is_active'),
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function edit(Iklan $iklan)
    {
        $positions = [
            'top_leaderboard' => 'Top Leaderboard (Banner Atas)',
            'sidebar_square' => 'Sidebar Square (Kotak Samping)',
            'in_feed_native' => 'In-Feed Native (Antara Berita)',
            'article_interruption' => 'Article Interruption (Dalam Berita)',
            'interstitial' => 'Interstitial (Pop-up/Overlay)',
            'wallpaper' => 'Wallpaper (Background Desktop)'
        ];
        return view('admin.iklan.edit', compact('iklan', 'positions'));
    }

    public function update(Request $request, Iklan $iklan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'url_link' => 'nullable|url',
            'position' => 'required|in:top_leaderboard,sidebar_square,in_feed_native,article_interruption,interstitial,wallpaper',
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($iklan->image_path) {
                Storage::disk('public')->delete($iklan->image_path);
            }
            $iklan->image_path = $request->file('image')->store('iklans', 'public');
        }

        $iklan->update([
            'title' => $request->title,
            'url_link' => $request->url_link,
            'position' => $request->position,
            'is_active' => $request->has('is_active'),
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil diperbarui.');
    }

    public function destroy(Iklan $iklan)
    {
        if ($iklan->image_path) {
            Storage::disk('public')->delete($iklan->image_path);
        }
        $iklan->delete();

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil dihapus.');
    }
}
