<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function create()
    {
        return view('profile.create');
    }

    public function register(ProfileRequest $request)
    {
        Profile::create([
            'user_id' => Auth::id(),
            'tel' => $request->input('tel'),
            'age' => $request->input('age'),
            'sex' => $request->input('sex'),
            'introduction' => $request->input('introduction'),
        ]);

        return 'true';
    }
}
