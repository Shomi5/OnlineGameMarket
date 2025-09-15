<?php

namespace App\Http\Controllers;

use App\Models\Izdavac;
use App\Models\Kljuc;
use App\Models\Kupovina;
use App\Models\Rezervacija;
use App\Models\VideoIgra;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDO;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{

    public function generisiOpis($nazivIgre)
    {
        if ($nazivIgre != null && empty($nazivIgre)) {
            return "Niste poslali ime igre";
        } else {

            try{
                $odgovor = Http::withToken(config('services.openai.laravel_key'))->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => 'Ti si AI koji piše kreativne opise video igara.'],
                    ['role' => 'user', 'content' => "Napiši **isključivo** jedan opis video igre '{$nazivIgre}' srednje dužine na srpskom jeziku. Opis **mora imati najviše 250 karaktera**. Ne dodaj ništa dodatno."],
                ],
                'temperature' => 0.7,
                'max_tokens' => 300,
            ])->json();
                
            if (isset($odgovor['error']) && $odgovor['error'] != null) {
                return false;
            }

            $opis = $odgovor['choices'][0]['message']['content'];
            return trim($opis, '"');
            }
            catch(ConnectionException $e){
                return false;
            }
            
        }
    }


    public function index()
    {

        $igre = VideoIgra::all();
        $korisnik = User::all();
        return View("adminPanel.index", ["igre" => $igre, "korisnik" => $korisnik]);
    }


    public function manipulacijaKorisnikom()
    {
        $korisnik = User::all();
        return View("adminPanel.manipulacijaKorisnikom", ["korisnik" => $korisnik]);
    }

    public function dodajKorisnika()
    {

        $attributes = request()->validate(
            [

                "Ime" => ["required"],
                "prezime" => ["required"],
                "email" => ["required", "email"],
                "status"=>["required"],
                "password" => ["required", RulesPassword::min(8)->letters(), "confirmed"],
            ],
            [
                "Ime.required" => "Polje za ime je obavezno!",
                "prezime.required" => "Polje za prezime je obavezno!",
                "email.required" => "Polje za e-mail je obavezno",
                "status.required" =>"Morate izabrati status korisnika",
                "password.required" => "Polje za password je obavezno",
                "password.min" => "Password mora imati minimim 8 karaktera",
                "password.letters" => "Password mora imati bar jedno slovo",
                "password.confirmed" => "Password se ne podudara"
            ]
        );


        $user = User::where('email', '=', $attributes['email'])->get();

        if (!$user->isEmpty()) {
            throw ValidationException::withMessages(["email" => "Ovaj e-mail je već  zauzet!"]);
        }

        User::create($attributes);

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste dodali korisnika";
        $podaci["poruka"] = "Korisnik: " . $attributes["Ime"] . " " . $attributes["prezime"];


        return redirect('/adminPanel/manipulacijaKorisnikom')->with("porukaUspeh", $podaci);
    }

    public function editKorisnika()
    {

        request()->validate(
            [
                "korisnickiEmailEdit" => ["required"]
            ],
            [
                "korisnickiEmailEdit.required" => "morate izabrati korisnika"
            ]
        );

        $editUser = User::where("id", request("korisnickiEmailEdit"))->first();
        $statusi =[0 => "Regularni status", 2 => "Moderator status"];
        return view("/adminPanel/editKorisnika", ["editUser" => $editUser , "statusi" => $statusi]);
    }


    public function updatePodataka()
    {

        request()->validate([
            "ime" => ["required"],
            "prezime" => ["required"],
            "email" => ["required", "email"],
            "statusKorisnika"=>["required"],
            "oldPassword" => ["required"],
            "password" => ["confirmed"]
        ], [
            "ime.required" => "Morate uneti ime",
            "prezime.required" => "Morate uneti prezime",
            "email.required" => "Morate uneti e-mail",
            "emial.email" => "Pogrešan format unosa",
            "statusKorisnika.email" => "Morate odabrati status korisnika",
            "oldPassword.required" => "Morate uneti vaš šifru",
            "password.confirmed" => "Šifre se ne podudaraju",
        ]);



        $userAdmin = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika

        if (!Hash::check(request("oldPassword"), $userAdmin->password)) {
            return back()->withErrors(["oldPassword" => "Uneta šifra nije tačna"]);
        }

        $userEdit = User::where("id", request("userID"))->first();

        $proveriMail = User::where("email", request("email"))->whereNot("id", request("userID"))->get();



        if (!$proveriMail->isEmpty()) {
            throw ValidationException::withMessages(["email" => "Ovaj e-mail je već  zauzet!"]);
        }

        if ($userEdit instanceof \App\Models\User) {
            $userEdit->Ime = request("ime");
            $userEdit->prezime = request("prezime");
            $userEdit->email = request("email");
            $userEdit->status = request("statusKorisnika");
            if (request("password")) {
                $userEdit->password = Hash::make(request("password"));
            }

            $userEdit->save(); // Sada bi Intelephense trebalo da prepozna
        }

        if (request()->hasfile("novaSlika")) {
            $path = 'profilneSlike/' . $userEdit->id . '.jpg';

            if (Storage::disk("images")->exists($path)) {

                Storage::disk('images')->delete($path);
            }

            Storage::disk("images")->putFileAs("profilPhotos", request()->file("novaSlika"), $userEdit->id . ".jpg");
        }

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste editovali korisnika";
        $podaci["poruka"] = "Korisnik: " . $userEdit->Ime . " " . $userEdit->Prezime . " Email: " . $userEdit->email;


        return redirect('/adminPanel/manipulacijaKorisnikom')->with("porukaUspeh", $podaci);
    }

    public function brisanjeKorisnika()
    {

        request()->validate(
            [
                "korisnickiEmailBrisanje" => ["required"],
                "passwordBrisanje" => ["required"]
            ],
            [
                "korisnickiEmailBrisanje.required" => "Morate izabrati korisnika kog želite da obrišete",
                "passwordBrisanje" => "Morate uneti vašu šifru"
            ]
        );

        $user = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika

        if (!Hash::check(request("passwordBrisanje"), $user->password)) {
            return back()->withErrors(["passwordBrisanje" => "Uneta šifra nije tačna"]);
        }
        $korisinik = User::where("id", request("korisnickiEmailBrisanje"))->select("email", "Ime", "prezime")->first();

        User::where("id", request("korisnickiEmailBrisanje"))->delete();

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste obrisali korisnika";
        $podaci["poruka"] = "Korisnik: " . $korisinik->Ime . " " . $korisinik->prezime . " Email: " . $korisinik->email;


        return redirect('/adminPanel/manipulacijaKorisnikom')->with("porukaUspeh", $podaci);
    }

    public function upravljanjeVideoIgrama()
    {
        $sveIgre = VideoIgra::all();
        $izdavaci = Izdavac::all();

        return View("adminPanel.upravljanjeVideoIgrama", ["sveIgre" => $sveIgre, "izdavaci" => $izdavaci]);
    }

    public function dodajVideoIgru()
    {
        request()->validate(
            [
                "nazivIgre" => ["required"],
                "izdavacIgre" => ["required"],
                "cenaIgre" => ["required"],
                "novaSlika" => ["required", "file", "mimes:jpg,jpeg,png"],
                "passwordDodajIgru" => ["required"]
            ],
            [
                "nazivIgre.required" => "Morate uneti naziv video igre",
                "izdavacIgre.required" => "Morate izabrati izdavača",
                "novaSlika.required" => "Morte izabrati sliku",
                "novaSlika.file" => "Fajl mora biti slika",
                "novaSlika.mimes" => "Format jpg",
                "cenaIgre.required" => "Cena igre je obavezan unos",
                "passwordDodajIgru.required" => "Morate uneti vašu šifru",
            ]
        );


        $user = Auth::user();

        if (!Hash::check(request("passwordDodajIgru"), $user->password)) {
            return back()->withErrors(["oldPassword" => "Uneta šifra nije tačna"]);
        }


        if (request()->hasfile("novaSlika")) {
            $path = 'slikeIgara/' . request("nazivIgre") . '.jpg';

            if (Storage::disk("images")->exists($path)) 
            {
                Storage::disk('images')->delete($path);
            }

            Storage::disk("images")->putFileAs("slikeIgara", request()->file("novaSlika"), request("nazivIgre") . ".jpg");
        }
        $opis = "";
        if (request("opisIgre") == null) {
            $opis = $this->generisiOpis(request("nazivIgre"));
            if($opis == false){
                throw ValidationException::withMessages(["opisIgre" => "Asistent trenutno nije dostupan. Morate sami uneti opis."]);
            }
        } else {
            $opis = request("opisIgre");
        }

        $postoji = VideoIgra::where("video_igra.Naziv", "=", request("nazivIgre"))->first();
        
        if ($postoji != null) {
            return redirect('/adminPanel/upravljanjeVideoIgrama')->with("igra_vec_postoji", request("nazivIgre"));
        }

        $resolt = VideoIgra::create([
            "Izdavac_ID" => request("izdavacIgre"),
            "Naziv" => request("nazivIgre"),
            "opisIgre" => $opis,
            "Cena_Igre" => request("cenaIgre"),
        ]);

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste dodali video igru";
        $podaci["poruka"] = "Video igra: " . request("nazivIgre");


        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("porukaUspeh", $podaci);
    }

    public function editVideo()
    {
        request()->validate(
            [
                "videoIgraEdit" => ["required"]
            ],
            [
                "videoIgraEdit.required" => "morate izabrati video igru"
            ]
        );

        $editIgra = VideoIgra::where("Igra_ID", request("videoIgraEdit"))->first();
        $izdavaci = VideoIgra::join("izdavac", "video_igra.izdavac_ID", "=", "izdavac.izdavac_ID")->where("video_igra.Igra_ID", $editIgra->Igra_ID)->select("izdavac.Izdavac_ID", "izdavac.Naziv")->first();
        $izdavaciNije = Izdavac::leftJoin("video_igra", "izdavac.Izdavac_ID", "=", "video_igra.Izdavac_ID")
            ->whereNotIn("izdavac.Izdavac_ID", function ($query) use ($editIgra) {
                $query->select("Izdavac_ID")
                    ->from("video_igra")
                    ->where("Igra_ID", $editIgra->Igra_ID);
            })->select("izdavac.Izdavac_ID", "izdavac.Naziv")->distinct()->get();

        return view("/adminPanel/editVideo", ["editIgra" => $editIgra, "izdavaci" => $izdavaci, "izdavaciNije" => $izdavaciNije]);
    }


    public function dodajKljuc()
    {
        request()->validate(
            [
                "videoIgra" => ["required"],
                "kljuc" => ["required", "regex:/^[0-9A-Z]{4}\-[0-9A-Z]{4}\-[0-9A-Z]{4}$/"],
            ],
            [
                "videoIgra.required" => "Morate izabrati igru",
                "kljuc.required" => "Morate uneti ključ",
                "kljuc.regex" => "Ključ mora biti u formatu XXXX-XXXX-XXXX, koristeći brojeve i velika slova.",
            ]
        );

        $novKljuc = Kljuc::where("Kljuc_ID", request()->input("kljuc"))->get();
        if (!$novKljuc->isEmpty()) {
            throw ValidationException::withMessages(["kljuc" => "Ovaj ključ je već dodat!"]);
        }

        Kljuc::create([
            "Kljuc_ID" => request("kljuc"),
            "Igra_ID" => request("videoIgra"),
        ]);

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste dodali ključ";
        $podaci["poruka"] = "Uneti ključ: " . request("kljuc");

        $rezervacija = Rezervacija::where("rezervacija.Igra_ID", "=", request("videoIgra"))->where("rezervacija.statusRezervacija", "=", 0)->orderby("Datum", "asc")->get();
        if ($rezervacija != null && !$rezervacija->isEmpty()) {

            foreach ($rezervacija as $rezKorisnika) {
                User::where("users.id", "=", $rezKorisnika->Korisnik_ID)->where("users.statusRezerKorisnika", "=", 0)->update(["users.statusRezerKorisnika" => 1]);
            }
        }

        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("porukaUspeh", $podaci);
    }

    public function listaKljuceva()
    {
        try {
            request()->validate(
                [
                    "videoIgraLista" => ["required"],
                    "kljuceviFajl" => ["required", "mimes:xls,xlsx"]
                ],
                [
                    "videoIgraLista.required" => "Morate izabrati igru",
                    "kljuceviFajl.required" => "Morate odabrati fajl sa ključevima",
                    "kljuceviFajl.mimes" => "Fajl mora biti u Excel formatu (.xls ili .xlsx)",
                ]
            );


            $data = Excel::toArray([], request("kljuceviFajl"));

            $redovi = $data[0];
            $listaKljuceva = [];
            $istiKljuc = 0;
            $nepravilanKljuc = 0;
            $dodatihKljuceva = 0;
            $informacije = [];
            $rezultatiLista = [];

            foreach ($redovi as $red) {

                if (count($red) != 1) {
                    throw ValidationException::withMessages(["kljuceviFajl" => "Fajl nije ispravno napisan."]);
                }


                $vrednost = trim($red[0]);
                if (!empty($vrednost)) {
                    $listaKljuceva[] = $vrednost;
                }
            }

            foreach ($listaKljuceva as $proKljuceva) {
                $proveraKljuca = Kljuc::where("Kljuc_ID", $proKljuceva)->first();
                if ($proveraKljuca != null) {
                    $istiKljuc++;
                    $rezultatiLista[] = ["kljuc" => $proKljuceva, "status" => "Postoji"];
                    continue;
                } else {
                    if (!preg_match("/^[0-9A-Z]{4}\-[0-9A-Z]{4}\-[0-9A-Z]{4}$/", $proKljuceva)) {
                        $nepravilanKljuc++;
                        $rezultatiLista[] = ["kljuc" => $proKljuceva, "status" => "Neispravan"];
                        continue;
                    } else {
                        Kljuc::create([
                            "Kljuc_ID" => $proKljuceva,
                            "Igra_ID" => request("videoIgraLista"),
                        ]);

                        $dodatihKljuceva++;
                        $rezultatiLista[] = ["kljuc" => $proKljuceva, "status" => "Dodat"];
                    }
                }
            }

            $informacije[] = ["stanje" => "Količina neispravnih ključeva", "vrednost"  => $nepravilanKljuc];
            $informacije[] = ["stanje" => "Količina ključeva koji se korsite", "vrednost"  => $istiKljuc];
            $informacije[] = ["stanje" => "Količina dodatih ključeva", "vrednost"  => $dodatihKljuceva];


            $rezervacija = Rezervacija::where("rezervacija.Igra_ID", "=", request("videoIgra"))->where("rezervacija.statusRezervacija", "=", 0)->orderby("Datum", "asc")->get();
            if ($rezervacija != null && !$rezervacija->isEmpty()) {

                foreach ($rezervacija as $rezKorisnika) {
                    User::where("users.id", "=", $rezKorisnika->Korisnik_ID)->where("users.statusRezerKorisnika", "=", 0)->update(["users.statusRezerKorisnika" => 1]);
                }
            }

            $poruka = "";

            if ($informacije[0]["vrednost"] == count($listaKljuceva)) {
                $poruka = "Neuspešno dodavanje ključeva. Svi ključevi se već koriste.";
            } else if ($informacije[1]["vrednost"] == count($listaKljuceva)) {
                $poruka = "Neuspešno dodavanje ključeva. Svi ključevi su neispravni.";
            } else if ($informacije[2]["vrednost"] == count($listaKljuceva)) {
                $poruka = "Uspešno ste dodali svih: " . count($listaKljuceva) . " ključeva.";
            } else if ($informacije[2]["vrednost"] == 0) {
                $poruka = "Niste uspeli da dodate nijedan ključ.";
            } else {
                $poruka = "Uspešno ste dodali " . $informacije[2]["vrednost"] . " ključeva.";
            }

            $KljuceviIgra = VideoIgra::where("Igra_ID", request("videoIgraLista"))->first();
            return redirect('/adminPanel/upravljanjeVideoIgrama')->with(["uspesna_lista" => $rezultatiLista, "poruka" => $poruka, "informacije" => $informacije, "kljuceviIgra" => $KljuceviIgra]);
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('statusKljuceva', true);
        }
    }




    public function obrisiIgru()
    {
        request()->validate(
            [
                "videoIgraBrisanje" => ["required"],
                "password_vasa" => ["required"],
            ],
            [
                "videoIgraBrisanje.required" => "Morate izabrati igru",
                "password_vasa.required" => "Unos šifre je obavezan",
            ]
        );

        $user = Auth::user();

        if (!Hash::check(request("password_vasa"), $user->password)) {
            return back()->withErrors(["password_vasa" => "Uneta šifra nije tačna"]);
        }



        $videoIgra = VideoIgra::where("Igra_ID", request("videoIgraBrisanje"))->select("Naziv")->first();
        VideoIgra::where("Igra_ID", request("videoIgraBrisanje"))->delete();

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste obrisali video igru";
        $podaci["poruka"] = "Video igra: " . $videoIgra->Naziv;


        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("porukaUspeh", $podaci);
    }


    public function updateVideoIgre()
    {

        request()->validate([
            "opisIgre" => ["required", "min:30", "max:500"],
            "nazivIgre" => ["required"],
            "izdavacIgre" => ["required"],
            "cenaIgre" => ["required"],
            "passwordDodajIgru" => ["required"],
            "password" => ["confirmed"]
        ], [
            "opisIgre.required" => "Morate uneti opis igre",
            'opisIgre.min' => 'Opis igre mora imati najmanje 30 karaktera.',
            'opisIgre.max' => 'Opis igre ne može imati više od 500 karaktera.',
            "nazivIgre.required" => "Morate uneti naziv video igre",
            "izdavacIgre.required" => "Morate izabrati izdavača",
            "cenaIgre.required" => "Morate uneti cenu igre",
            "passwordDodajIgru.required" => "Morate uneti vaš šifru",
        ]);



        $userAdmin = Auth::user(); // Dohvatanje trenutno prijavljenog korisnika

        if (!Hash::check(request("passwordDodajIgru"), $userAdmin->password)) {
            return back()->withErrors(["passwordDodajIgru" => "Uneta šifra nije tačna"]);
        }

        $igraEdit = VideoIgra::where("Igra_ID", request("sifra"))->first();


        if ($igraEdit instanceof \App\Models\VideoIgra) {
            $igraEdit->Izdavac_ID  = request("izdavacIgre");
            $igraEdit->Naziv = request("nazivIgre");
            $igraEdit->opisIgre = request("opisIgre");
            $igraEdit->Cena_Igre = request("cenaIgre");

            $igraEdit->save(); // Sada bi Intelephense trebalo da prepozna
        }

        if (request()->hasfile("novaSlika")) {
            $path = 'slikeIgara/' . $igraEdit->Naziv . '.jpg';

            if (Storage::disk("images")->exists($path)) {

                Storage::disk('images')->delete($path);
            }

            Storage::disk("images")->putFileAs("slikeIgara", request()->file("novaSlika"), $igraEdit->Naziv . ".jpg");
        }

        $podaci = [];
        $podaci["naslov"] = "Uspešno ste azurirali video igru";
        $podaci["poruka"] = "Video igra: " . $igraEdit->Naziv;


        return redirect('/adminPanel/upravljanjeVideoIgrama')->with("porukaUspeh", $podaci);
    }


    public function upravljanjeRezervacijama()
    {

        $rezervacijeObradjene = Rezervacija::where("rezervacija.statusRezervacija", 1)->join("video_igra", "rezervacija.Igra_ID", "video_igra.Igra_ID")
            ->join("users", "rezervacija.Korisnik_ID", "users.id")
            ->orderby("statusRezervacija", "desc")
            ->orderby("Datum", "desc")->get();

        $rezervacijeNeobradjenie = Rezervacija::where("rezervacija.statusRezervacija", 0)->join("video_igra", "rezervacija.Igra_ID", "video_igra.Igra_ID")
            ->join("users", "rezervacija.Korisnik_ID", "users.id")
            ->orderby("statusRezervacija", "asc")
            ->orderby("Datum", "asc")->get();

        return View("adminPanel.upravljanjeRezervacijama", ["rezervacijeObradjene" => $rezervacijeObradjene, "rezervacijeNeobradjenie" => $rezervacijeNeobradjenie]);
    }

    public function ukloniRezervaciju(int $Rezervacija_ID)
    {
        $rezervacijaRezultat = Rezervacija::where("Rezervacija_ID", $Rezervacija_ID)->delete();

        if ($rezervacijaRezultat != null && $rezervacijaRezultat > 0) {
            $podaci = [];
            $podaci["naslov"] = "Uspešno ste obrisali rezervaciju";
            $podaci["poruka"] = "Korisniča rezervacija je obrisana";
            $podaci["greska"] = false;
        } else {
            $podaci["naslov"] = "Rezervacija nije obrisana";
            $podaci["poruka"] = "Došlo je do greške prilikom brisanja";
            $podaci["greska"] = true;
        }

        return redirect('/adminPanel/upravljanjeRezervacijama')->with("porukaUspeh", $podaci);
    }
}
