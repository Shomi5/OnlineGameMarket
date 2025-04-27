<?php

namespace App\Http\Controllers;

use App\Models\Izdavac;
use App\Models\Kljuc;
use App\Models\VideoIgra;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){
        
        $igre = VideoIgra::all();
        $korisnik = User::all();
        return View("adminPanel.index",["igre"=>$igre,"korisnik"=>$korisnik]);
    }
    
    
    public function manipulacijaKorisnikom(){
        $korisnik = User::all();
        return View("adminPanel.manipulacijaKorisnikom",["korisnik"=>$korisnik]);
    }
    
    public function dodajKorisnika(){
        
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
        
        User::create($attributes);
        
        return redirect('/adminPanel/manipulacijaKorisnikom')->with("uspesno_dodavanje_korisnika" , $attributes["Ime"] . " " . $attributes["prezime"]);
    }
    
    public function editKorisnika(){
        
        request()->validate([
            "korisnickiEmailEdit" => ["required"]
        ],
        [
            "korisnickiEmailEdit.required" => "morate izabrati korisnika"
        ]);
        
        $editUser=User::where("id",request("korisnickiEmailEdit"))->first();
        
        return view("/adminPanel/editKorisnika",["editUser" => $editUser]);
        
    }
    
    
    public function updatePodataka(){
        
        request()->validate([
            "ime" => ["required"],
            "prezime" => ["required"],
            "email" => ["required","email"],
            "oldPassword"=> ["required"],
            "password" => ["confirmed"]
        ],[
            "ime.required" => "Morate uneti ime",
            "prezime.required" => "Morate uneti prezime",
            "email.required" => "Morate uneti e-mail",
            "emial.email" => "Pogrešan format unosa",
            "oldPassword.required" => "Morate uneti vaš šifru",
            "password.confirmed" => "Šifre se ne podudaraju",
        ]);
        
        
        
        $userAdmin = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika
        
        if (!Hash::check(request("oldPassword"), $userAdmin->password)) {
            return back()->withErrors(["oldPassword" => "Uneta šifra nije tačna"]);
        }
        
        $userEdit = User::where("email",request("email"))->first();
        
        $proveriMail = User::where("email",request("email"))->whereNot("id",request("userID"))->get();
        
        
        
        if(!$proveriMail->isEmpty())
        {
            throw ValidationException::withMessages(["email" => "Ovaj e-mail je već  zauzet!"]);
        }
        
        if ($userEdit instanceof \App\Models\User) {
            $userEdit->Ime = request("ime");
            $userEdit->prezime = request("prezime");
            $userEdit->email = request("email");
            if(request("password")) {
                $userEdit->password = Hash::make(request("password"));
            }
            
            $userEdit->save(); // Sada bi Intelephense trebalo da prepozna
        }
        
        if(request()->hasfile("novaSlika"))
        {
            $path = 'profilneSlike/' . $userEdit->id . '.jpg';
            
            if(Storage::disk("images")->exists($path)){
                
                Storage::disk('images')->delete($path);
            }
            
            Storage::disk("images")->putFileAs("profilPhotos",request()->file("novaSlika"), $userEdit->id . ".jpg");
        }
        
        return redirect('/adminPanel/editKorisnika')->with("uspesno_modifikovan_korinsik",$userEdit->Ime . " " . $userEdit->Prezime. " Email: " . $userEdit->email);
        
    }
    
    public function brisanjeKorisnika(){
        
        request()->validate([
            "korisnickiEmailBrisanje" => ["required"],
            "passwordBrisanje" => ["required"]
        ],
        [
            "korisnickiEmailBrisanje.required" => "Morate izabrati korisnika kog želite da obrišete",
            "passwordBrisanje" => "Morate uneti vašu šifru"
        ]);
        
        $user = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika
        
        if (!Hash::check(request("passwordBrisanje"), $user->password)) {
            return back()->withErrors(["passwordBrisanje" => "Uneta šifra nije tačna"]);
        }
        $korisinik = User::where("id",request("korisnickiEmailBrisanje"))->select("email","Ime","prezime")->first();
        
        User::where("id",request("korisnickiEmailBrisanje"))->delete();
        
        return redirect('/adminPanel/manipulacijaKorisnikom')->with("uspesno_obrisan_korinsik", $korisinik->Ime ." " . $korisinik->prezime . " Email: " . $korisinik->email);
        
    }
    
    public function upravljanjeVideoIgrama(){
        $sveIgre = VideoIgra::all();
        $izdavaci = Izdavac::all();
        
        return View("adminPanel.upravljanjeVideoIgrama",["sveIgre" => $sveIgre, "izdavaci" => $izdavaci]);
    }
    
    public function dodajVideoIgru()
    {
        request()->validate([
            "sifra" => ["required"],
            "nazivIgre" => ["required"],
            "izdavacIgre" => ["required"],
            "cenaIgre"=>["required"],
            "novaSlika" =>["required","file","mimes:jpg,jpeg,png"],
            "passwordDodajIgru" => ["required"]
        ],
        [
            "sifra.required" => "Morate uneti šifru",
            "nazivIgre.required" => "Morate uneti naziv video igre",
            "izdavacIgre.required" => "Morate izabrati izdavača",
            "novaSlika.required" => "Morte izabrati sliku",
            "novaSlika.file" => "Fajl mora biti slika",
            "novaSlika.mimes" => "Format jpg",
            "cenaIgre.required" => "Cena igre je obavezan unos",
            "passwordDodajIgru.required" => "Morate uneti vašu šifru",
        ]);
        
        
        // dd(request()->all());
        $novKljuc = VideoIgra::where("Igra_ID",request()->input("sifra"))->get();
        
        if(!$novKljuc->isEmpty())
        {
            throw ValidationException::withMessages(["sifra" => "Igra sa ovom šifrom je već uneta"]);
        }
        
        $user = Auth::user();
        
        if (!Hash::check(request("passwordDodajIgru"), $user->password)) {
            return back()->withErrors(["oldPassword" => "Uneta šifra nije tačna"]);
        }
        
        
        if(request()->hasfile("novaSlika"))
        {
            $path = 'profilneSlike/' . request("nazivIgre") . '.jpg';
            
            if(Storage::disk("images")->exists($path)){
                
                Storage::disk('images')->delete($path);
            }
            
            Storage::disk("images")->putFileAs("slikeIgara",request()->file("novaSlika"), request("nazivIgre") . ".jpg");
        }
        
        
        VideoIgra::create([
            "Igra_ID" => request("sifra"),
            "Izdavac_ID" => request("izdavacIgre"),
            "Naziv" => request("nazivIgre"),
            "Cena_Igre" => request("cenaIgre"),
        ]);
        
        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("uspesno_unta_igra", request("nazivIgre"));
        
        
    }
    
    public function editVideo()
    {
        request()->validate([
            "videoIgraEdit" => ["required"]
        ],
        [
            "videoIgraEdit.required" => "morate izabrati korisnika"
        ]);
        
        $editIgra=VideoIgra::where("Igra_ID",request("videoIgraEdit"))->first();
        $izdavaci=VideoIgra::join("izdavac","video_igra.izdavac_ID","=","izdavac.izdavac_ID")->where("video_igra.Igra_ID",$editIgra->Igra_ID)->select("izdavac.Izdavac_ID", "izdavac.Naziv")->first();
        $izdavaciNije = Izdavac::leftJoin("video_igra", "izdavac.Izdavac_ID", "=", "video_igra.Izdavac_ID")
        ->whereNotIn("izdavac.Izdavac_ID", function($query) use ($editIgra) {
            $query->select("Izdavac_ID")
            ->from("video_igra")
            ->where("Igra_ID", $editIgra->Igra_ID);
        })->select("izdavac.Izdavac_ID", "izdavac.Naziv")->distinct()->get();
        
        
        return view("/adminPanel/editVideo",["editIgra" => $editIgra, "izdavaci" => $izdavaci, "izdavaciNije" => $izdavaciNije]);
    }
    
    
    public function dodajKljuc()
    {
        request()->validate([
            "videoIgra" => ["required"],
            "kljuc" => ["required","regex:/^[0-9A-Z]{4}\-[0-9A-Z]{4}\-[0-9A-Z]{4}$/"],
        ],
        [
            "videoIgra.required" => "Morate izabrati igru",
            "kljuc.required" => "Morate uneti ključ",
            "kljuc.regex" => "Ključ mora biti u formatu XXXX-XXXX-XXXX, koristeći brojeve i velika slova.",
        ]);
        
        $novKljuc = Kljuc::where("Kljuc_ID",request()->input("kljuc"))->get();
        
        if(!$novKljuc->isEmpty())
        {
            throw ValidationException::withMessages(["kljuc" => "Ovaj ključ je već dodat!"]);
            
        }
        
        Kljuc::create([
            "Kljuc_ID" => request("kljuc"),
            "Igra_ID" => request("videoIgra"),
        ]);
        
        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("uspesan_kljuc", request("kljuc"));
        
    }
    
    
    public function obrisiIgru()
    {
        request()->validate([
            "videoIgraBrisanje" => ["required"],
            "password_vasa" => ["required"],
        ],
        [
            "videoIgraBrisanje.required" => "Morate izabrati igru",
            "password_vasa.required" => "Unos šifre je obavezan",
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check(request("password_vasa"), $user->password)) {
            return back()->withErrors(["password_vasa" => "Uneta šifra nije tačna"]);
        }
        
        
        $videoIgra = VideoIgra::where("Igra_ID",request("videoIgraBrisanje"))->select("Naziv")->first();
        VideoIgra::where("Igra_ID",request("videoIgraBrisanje"))->delete();
        
        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("uspesno_obrisana", $videoIgra->Naziv);
        
    }
    
    
    public function updateVideoIgre(){
        
        request()->validate([
            "sifra" => ["required"],
            "nazivIgre" => ["required"],
            "izdavacIgre" => ["required"],
            "cenaIgre" => ["required"],
            "passwordDodajIgru"=> ["required"],
            "password" => ["confirmed"]
        ],[
            "sifra.required" => "Morate uneti šifru",
            "nazivIgre.required" => "Morate uneti naziv video igre",
            "izdavacIgre.required" => "Morate izabrati izdavača",
            "cenaIgre.required" => "Morate uneti cenu igre",
            "passwordDodajIgru.required" => "Morate uneti vaš šifru",
        ]);
        
        
        
        $userAdmin = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika
        
        if (!Hash::check(request("passwordDodajIgru"), $userAdmin->password)) {
            return back()->withErrors(["passwordDodajIgru" => "Uneta šifra nije tačna"]);
        }
        
        $igraEdit = VideoIgra::where("Igra_ID",request("sifra"))->first();

        
        if ($igraEdit instanceof \App\Models\VideoIgra) {
            $igraEdit->Izdavac_ID  = request("izdavacIgre");
            $igraEdit->Naziv = request("nazivIgre");
            $igraEdit->Cena_Igre = request("cenaIgre");

            $igraEdit->save(); // Sada bi Intelephense trebalo da prepozna
        }
        
        if(request()->hasfile("novaSlika"))
        {
            $path = 'profilneSlike/' . $igraEdit->Naziv . '.jpg';
            
            if(Storage::disk("images")->exists($path)){
                
                Storage::disk('images')->delete($path);
            }
            
            Storage::disk("images")->putFileAs("profilPhotos",request()->file("novaSlika"), $igraEdit->Naziv . ".jpg");
        }
        
        return redirect('/adminPanel/editKorisnika')->with("uspesno_modifikovan_igru",$igraEdit->Naziv);
    }


    public function upravljanjePromocijama(){
        return View("adminPanel.upravljanjePromocijama");
    }
}
