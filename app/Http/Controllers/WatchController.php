<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function index()
    {
        $video = Video::orderBy('id', 'desc')->latest()->paginate(8);
        return view('watch', compact('video'));
    }
}
