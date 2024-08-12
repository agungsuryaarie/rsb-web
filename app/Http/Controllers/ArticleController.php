<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    public function index()
    {

        $pagination = 9;
        $article = Post::orderBy('id', 'desc')->where('category_id', '=', '1')->latest()->paginate($pagination);
        $other_post = Post::limit(6)->get();
        return view('article', compact('article', 'pagination', 'other_post'));
    }

    public function show(Post $article)
    {
        $title = $article->title;
        $other_post = Post::limit(6)->get();
        return view('article_show', compact('title', 'article', 'other_post'));
    }
};
