<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email:dns|unique:users',
            'username' => 'required|min:3|max:12|unique:users',
            'password' => ['required', 'min:3', 'max:12']
        ]);

        User::create($validatedData);

        $request->session()->flash('success', 'Registration successful!');

        return redirect('/login');
    }

}
