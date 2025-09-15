<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;

class LoginUserController extends Controller
{
    public function login()
    {
        return View("auth.login");
    }

    public function store()
    {
        $attributes = request()->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ],[
            "email.required" => "Polje za e-mail je obavezno!",
            "password.required" => "Polje za password je obavezno!"
        ]);

        if(!Auth::attempt($attributes)){
            throw ValidationException::withMessages(["email" => "Uneti podatci nisu ispravni"]);
        }

        request()->session()->regenerate();

        return redirect("/");
    }


    public function destroy()
    {
        Cookie::queue(Cookie::forget('brojac_poseta'));
        Auth::logout();

        return redirect("/");
    }
}
