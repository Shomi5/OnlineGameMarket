<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kupovina;
use App\Models\Rezervacija;
use App\Models\VideoIgra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserAccountController extends Controller
{
    public function index()
    {
        $kupovine = Kupovina::where("kupovina.Korisnik_ID", "=", Auth::user()->id)
            ->join("kljuc", "kupovina.Kljuc_ID", "kljuc.Kljuc_ID")
            ->join("video_igra", "kljuc.Igra_ID", "video_igra.Igra_ID")
            ->orderby("Datum", "desc")->get();

        
        return View("userAccount.index", ["kupovine" => $kupovine]);
    }

    public function rezervacijeKorisnika(){
        
        $rezervacije = Rezervacija::where("rezervacija.Korisnik_ID","=",Auth::user()->id)
        ->join("video_igra", "rezervacija.Igra_ID", "video_igra.Igra_ID")
        ->join("users","rezervacija.Korisnik_ID","users.id")
        ->orderby("statusRezervacija", "asc")
        ->orderby("Datum", "asc")->get();
        return View("userAccount.korisnickeRezervacije",["rezervacije" => $rezervacije]);
    }

    public function edit()
    {
        return View("userAccount.edit");
    }

    public function update()
    {


        FacadesLog::info("Funkcija dodajVideoIgru je pozvana!");


        request()->validate([
            "ime" => ["required"],
            "prezime" => ["required"],
            "email" => ["required", "email"],
            "oldPassword" => ["required"],
            "password" => ["confirmed"]
        ], [
            "ime.required" => "Morate uneti ime",
            "prezime.required" => "Morate uneti prezime",
            "email.required" => "Morate uneti e-mail",
            "emial.email" => "Pogrešan format unosa",
            "oldPassword.required" => "Morate uneti vaš šifru",
            "password.confirmed" => "Šifre se ne podudaraju",
        ]);



        $user = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika

        if (!Hash::check(request("oldPassword"), $user->password)) {
            return back()->withErrors(["oldPassword" => "Uneta šifra nije tačna"]);
        }

        $userEdit = User::where("email", request("email"))->first();

        $proveriMail = User::where("email", request("email"))->whereNot("id", $user->id)->get();



        if (!$proveriMail->isEmpty()) {
            throw ValidationException::withMessages(["email" => "Ovaj e-mail je već  zauzet!"]);
        }


        if ($user instanceof \App\Models\User) {
            $user->Ime = request("ime");
            $user->prezime = request("prezime");
            $user->email = request("email");
            if (request("password")) {
                $user->password = Hash::make(request("password"));
            }

            $user->save(); // Sada bi Intelephense trebalo da prepozna
        }

        if (request()->hasfile("novaSlika")) {
            $path = 'profilneSlike/' . $user->id . '.jpg';

            if (Storage::disk("images")->exists($path)) {

                Storage::disk('images')->delete($path);
            }

            Storage::disk("images")->putFileAs("profilPhotos", request()->file("novaSlika"), $user->id . ".jpg");
        }

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste azurirali podatke";
        $podaci["poruka"] = "Korisnik: " . $user->Ime . " " . $user->prezime . " Email: " . $user->email;


        return redirect('/userAccount')->with("porukaUspeh", $podaci);
    }
}
