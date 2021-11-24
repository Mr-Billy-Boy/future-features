<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginWithGoogle(Request $request)
    {
        $user                   = User::findOrNew('email', $request->email);
        $user->name             = $request->given_name ." ". $request->family_name;
        $user->email            = $request->email;
        $user->profile_image    = $request->profile_image;
        $user->save();

        return $user;
    }
}
