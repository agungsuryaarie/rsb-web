<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;



class GaleriController extends Controller
{
    public function index()
    {
        // $menu = "Radio Suara batu bara";
        $album = Album::orderBy('id', 'desc')->latest()->paginate(9);
        return view('galeri', compact('album'));
    }
    public function show($id)
    {
        $album = Album::orderBy('id', 'desc')->find($id);
        $detail = Photo::where('album_id', $id)->get();
        return view('galeri_show', compact('album', 'detail'));
    }
}
