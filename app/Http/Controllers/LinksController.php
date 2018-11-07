<?php

namespace App\Http\Controllers;

use App\Links;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url'=> 'required|url'
        ]);
    
        $link = new Links;
        $link->main_url = $request->url;
        $link->shortened_url = uniqid();
        if (auth()->user()) {
            $link->user_id = auth()->user()->id;
            $link->unauthed = 0;
        }
        $link->save();
        return redirect()->back()->with(['link' => $link->main_url, 'shr' =>$link->shortened_url]);
    }

    
    public function goto($url)
    {
        $link = Links::where('shortened_url', $url)->first();
        return redirect('http://'.$link->main_url);
    }

    public function unauthed()
    {
        $links = Links::where('unauthed', 1)->latest()->paginate(20);
       // dd($links->previousPageUrl());
        return view('home', compact('links'));
    }

}
