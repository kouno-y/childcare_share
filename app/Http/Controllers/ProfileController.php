<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function create()
    {
        return view('profile.create');
    }

    public function register(ProfileRequest $request)
    {

        return 'true';
    }
}
