<?php

namespace App\Http\Controllers;

use App\Poem;

class PoemsController extends Controller
{
    public function index()
    {
        return Poem::all();
    }
}
