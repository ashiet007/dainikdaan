<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class HomeController extends Controller
{

    public function index()
    {
        $news = News::vertical()->first();
        return view('welcome',compact('news'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }

    public function plan()
    {
        return view('plan');
    }

    public function block()
    {
        return view('block');
    }
}
