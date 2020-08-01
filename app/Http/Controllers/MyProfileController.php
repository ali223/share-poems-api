<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class MyProfileController extends Controller
{
    public function index()
    {
        $currentUser = new UserResource(auth()->user());

        return $currentUser;
    }
}
