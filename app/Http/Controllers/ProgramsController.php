<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Program;
use Illuminate\Support\Facades\Http;

class ProgramsController extends Controller
{
    public function index()
    {

        $programs = Program::orderBy('id', 'desc')->limit(4)->get();
        return view('programs', compact('programs'));
    }

    public function show(Program $programs)
    {
        $title = $programs->title;
        $other_programs = Program::limit(6)->get();
        return view('programs_show', compact('title', 'programs', 'other_programs'));
    }
}
