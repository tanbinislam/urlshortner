<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Links;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Links::where('user_id', auth()->user()->id)->latest()->paginate(20);
        //dd('links')
        return view('home', compact('links'));
    }
}
