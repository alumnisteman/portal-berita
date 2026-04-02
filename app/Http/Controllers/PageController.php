<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function privacy()
    {
        return view('pages.privacy-policy');
    }

    public function about()
    {
        return view('pages.about');
    }
}
