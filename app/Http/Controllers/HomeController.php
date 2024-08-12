<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Program;
use App\Models\User;
use App\Models\Video;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index()
    {
        $article = Post::orderBy('id', 'desc')->where('category_id', '=', '1')->limit(1)->get();
        $article1 = Post::orderBy('id', 'desc')->where('category_id', '=', '1')->offset(1)->limit(2)->get();
        $article2 = Post::orderBy('id', 'desc')->where('category_id', '=', '1')->offset(3)->limit(2)->get();
        $video = Video::orderBy('id', 'desc')->limit(1)->get();
        $video1 = Video::orderBy('id', 'desc')->offset(1)->limit(2)->get();
        $programs = Program::orderBy('id', 'desc')->limit(4)->get();
        $penyiar = User::with('profile')->where('host', 1)->get();
        return view('home', compact('article', 'article1', 'article2', 'programs', 'video', 'video1', 'penyiar'));
    }
}
