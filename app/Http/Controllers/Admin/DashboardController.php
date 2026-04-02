<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Iklan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_berita' => Berita::count(),
            'total_iklan' => Iklan::count(),
            'active_iklan' => Iklan::active()->count(),
            'published_berita' => Berita::where('status', 'published')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
