<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterUserController extends Controller
{
    public function create()
    {
        return View("auth.register");
    }

    public function store()
    {
       

        $attributes = request()->validate([

            "Ime" => ["required"],
            "prezime" => ["required"],
            "email" => ["required","email"],
            "password" => ["required",RulesPassword::min(8)->letters(),"confirmed"],
        ],
        [
            "Ime.required" => "Polje za ime je obavezno!",
            "prezime.required" => "Polje za prezime je obavezno!",
            "email.required" => "Polje za e-mail je obavezno",
            "password.required" => "Polje za password je obavezno",
            "password.min" => "Password mora imati minimim 8 karaktera",
            "password.letters" => "Password mora imati bar jedno slovo",
            "password.confirmed" => "Password se ne podudara"
        ]);

        
        $user = User::where('email', '=', $attributes['email'])->get();

        if(!$user->isEmpty())
        {
            throw ValidationException::withMessages(["email" => "Ovaj e-mail je već  zauzet!"]);
        }

        $korisnik = User::create($attributes);

        Auth::login($korisnik);

        return redirect("/");
    }
}
