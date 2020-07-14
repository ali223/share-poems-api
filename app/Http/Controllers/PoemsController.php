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

    public function show($id)
    {
        $poem = Poem::findOrFail($id);

        return new PoemResource($poem);
    }
}
