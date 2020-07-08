<?php

namespace App\Http\Controllers;

use App\Http\Resources\PoemResource;
use App\Poem;

class PoemsController extends Controller
{
    public function index()
    {
        return PoemResource::collection(Poem::all());
    }
}
