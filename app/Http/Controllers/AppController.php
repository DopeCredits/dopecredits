<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function stacking()
    {
        return view('stacking');
    }
}
