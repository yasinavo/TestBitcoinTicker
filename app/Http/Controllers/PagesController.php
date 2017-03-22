<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{
    
    
    Public function about()
    {
        $people = ['Sam','Jack','Tom'];
        return view('pages.about', compact('people'));
    }
}
