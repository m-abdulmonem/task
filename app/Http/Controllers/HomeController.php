<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('frontend.pages.home');
    }


    public function blocked()
    {
        abort_if(auth()->check() && !auth()->user()->isBlocked(),404);

        return view("frontend.pages.blocked");
    }
}
