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
            'url'=> 'required|url',
        ]);

        $short_url = $this->generateUrlId();

        while (Links::all()->contains($short_url)) {
            $short_url = $this->generateUrlId();
        }
        $link = new Links();
        $link->main_url = $request->url;
        $link->shortened_url = $short_url;
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

        return redirect($link->main_url);
    }

    public function unauthed()
    {
        $links = Links::where('unauthed', 1)->latest()->paginate(20);
        //dd($links);
        return view('home', compact('links'));
    }

    public function generateUrlId()
    {
        return strtoupper(str_random(7));
    }
}
