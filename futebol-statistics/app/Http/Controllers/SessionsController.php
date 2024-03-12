<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class SessionsController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(Request $request)
{
    $attributes = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (auth()->attempt($attributes)) {
        $user = auth()->user();

        if ($user-> is_admin === 1) {
            return redirect('admin/')->with('success', 'Admin logged in successfully.');
        } else {
            return redirect('/')->with('success', 'User logged in successfully.');
        }
    }

    throw ValidationException::withMessages([
        'email' => 'Your provided credentials were not verified',
    ]);
}

    public function destroy(Request $request)
    {
        $guard = $request->input('isAdminLogin') ? 'admin' : null;

        auth()->guard($guard)->logout();
        Session::flush();

        return redirect("/login")->with("success", "Goodbye");
    }
}
