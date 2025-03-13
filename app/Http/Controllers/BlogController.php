<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs');
    }

    public function show($slug)
    {
        return view('blog-single', ['slug' => $slug]);
    }
}
