<?php

namespace App\Http\Controllers;

use App\Http\Resources\PoemResource;
use App\Poem;

class MyPoemsController extends Controller
{
    public function index()
    {
        $myPoems = auth()->user()->poems;

        return PoemResource::collection($myPoems);
    }
}
