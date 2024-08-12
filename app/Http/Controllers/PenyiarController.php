<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use Illuminate\Support\Facades\Http;

class PenyiarController extends Controller
{
    public function index()
    {
        $penyiar = Profile::with('user')
            ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
            ->where('users.host', 1)
            ->select('profiles.*')
            ->get();

        return view('penyiar', compact('penyiar'));
    }
}
