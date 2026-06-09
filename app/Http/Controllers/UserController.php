<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($validated)) {
            if (Auth::user()->is_admin) {
                return redirect()->route('adnin.main.index');
            } else {
                return redirect('home');
            }
        }

        return redirect()->back()->with('error', 'Incorrect email/password');
    }
}
