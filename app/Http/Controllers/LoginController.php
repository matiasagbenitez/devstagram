<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {

        if (auth()->user()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Wrong credentials :(');
        }

        return redirect()->route('posts.index', auth()->user());

    }
}
