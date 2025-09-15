<?php

namespace App\Http\Controllers;

use App\Models\Kljuc;
use App\Models\Kupovina;
use App\Models\VideoIgra;
use App\Models\User;
use App\Mail\ContactMessage;
use App\Models\Rezervacija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class ProdajaController extends Controller
{
    public function myCookie()
    {
        $brojPoseta = (int) Cookie::get('brojac_poseta', 0);
        if ($brojPoseta === 0) {
            $brojPoseta = 1;
        } else {
            $brojPoseta++;
        }
        Cookie::queue('brojac_poseta', $brojPoseta, 60 * 24 * 30);
        return $brojPoseta;
    }



    public function index()
    {

        $igra = VideoIgra::join("izdavac", "video_igra.izdavac_ID", "=", "izdavac.izdavac_ID")->select("video_igra.*", "izdavac.Naziv as izdavacNaziv")->orderBy('video_igra.Cena_Igre', 'asc')->take(3)->get();
        $igraNajNovije = VideoIgra::join("izdavac", "video_igra.izdavac_ID", "=", "izdavac.izdavac_ID")->select("video_igra.*", "izdavac.Naziv as izdavacNaziv")->orderBy('video_igra.Igra_ID', 'desc')->orderBy('video_igra.Igra_ID', 'asc')->take(3)->get();
        $sveigre = VideoIgra::all();
        if (Auth::guest()) {
            return View("prodaja.index", ["igra" => $igra, "sveigre" => $sveigre, "Cookie" => 0, "omoguceneRezervacije" => null, "igraNajNovije" => $igraNajNovije]);
        } else {


            $omoguceneRezervacije = Rezervacija::join('video_igra', 'video_igra.Igra_ID', '=', 'rezervacija.Igra_ID')
                ->where('rezervacija.Korisnik_ID', Auth::user()->id)
                ->where('rezervacija.statusRezervacija', 0)
                ->whereExists(function ($query) {
                    $query->select(Kljuc::raw(1))
                        ->from('kljuc')
                        ->whereColumn('kljuc.Igra_ID', 'rezervacija.Igra_ID')
                        ->where('kljuc.Status', 1);
                })
                ->select('video_igra.*')
                ->distinct()
                ->get();
            if (!$omoguceneRezervacije->isEmpty()) {
                $cookie = $this->myCookie();
            } else {
                $cookie = 0;
            }

            return View("prodaja.index", ["igra" => $igra, "sveigre" => $sveigre, "Cookie" => $cookie, "omoguceneRezervacije" => $omoguceneRezervacije ,  "igraNajNovije" => $igraNajNovije]);
        }
    }

    public function show(VideoIgra $igra)
    {
        $igrica = VideoIgra::where("video_igra.Naziv", $igra->Naziv)->join("izdavac", "video_igra.izdavac_ID", "=", "izdavac.izdavac_ID")->select("video_igra.*", "izdavac.Naziv as izdavacNaziv")->first();
        $igraKey = VideoIgra::where("video_igra.Naziv", $igra->Naziv)
            ->join("kljuc", "video_igra.Igra_ID", "=", "kljuc.Igra_ID")
            ->where("kljuc.status", 1)
            ->exists();

        return view('prodaja.show', ["igra" => $igrica, "kljucIgre" => $igraKey]);
    }

    public function pretraziProizvod(Request $request)
    {

        $igra = VideoIgra::join("izdavac", "video_igra.izdavac_ID", "=", "izdavac.izdavac_ID")
            ->select("video_igra.*", "izdavac.Naziv as izdavacNaziv")
            ->orderBy('video_igra.Cena_Igre', 'asc')
            ->take(3)
            ->get();
            
        $igraNajNovije = VideoIgra::join("izdavac", "video_igra.izdavac_ID", "=", "izdavac.izdavac_ID")
            ->select("video_igra.*", "izdavac.Naziv as izdavacNaziv")
            ->orderBy('video_igra.Igra_ID', 'desc')
            ->orderBy('video_igra.Igra_ID', 'asc')
            ->take(3)
            ->get();

        $query = VideoIgra::query();

        if ($request->filled('nazivIgre')) {
            $query->where('Naziv', 'LIKE', '%' . $request->nazivIgre . '%');
        }

        if ($request->filled('minCena')) {
            $query->where('Cena_Igre', '>=', $request->minCena);
        }

        if ($request->filled('maxCena')) {
            $query->where('Cena_Igre', '<=', $request->maxCena);
        }


        if ($request->filled('sortCena') && in_array($request->sortCena, ['asc', 'desc'])) {
            $query->orderBy('Cena_Igre', $request->sortCena);
        }

        $sveigre = $query->get();

        
        if (Auth::guest()) {
            return view("prodaja.index", [
                "igra" => $igra,
                "sveigre" => $sveigre,
                "Cookie" => 0,
                "omoguceneRezervacije" => null,
                "igraNajNovije" => $igraNajNovije
            ]);
        } else {
            $omoguceneRezervacije = Rezervacija::join('video_igra', 'video_igra.Igra_ID', '=', 'rezervacija.Igra_ID')
                ->where('rezervacija.Korisnik_ID', Auth::user()->id)
                ->where('rezervacija.statusRezervacija', 0)
                ->whereExists(function ($query) {
                    $query->select(Kljuc::raw(1))
                        ->from('kljuc')
                        ->whereColumn('kljuc.Igra_ID', 'rezervacija.Igra_ID')
                        ->where('kljuc.Status', 1);
                })
                ->select('video_igra.*')
                ->distinct()
                ->get();

            $cookie = $omoguceneRezervacije->isEmpty() ? 0 : $this->myCookie();

            return view("prodaja.index", [
                "igra" => $igra,
                "sveigre" => $sveigre,
                "Cookie" => $cookie,
                "omoguceneRezervacije" => $omoguceneRezervacije,
                "igraNajNovije" => $igraNajNovije,
            ]);
        }
    }

    public function odustaniRezervacija(int $Rezervacija_ID)
    {
        $rezervacijaUspela = Rezervacija::where("Rezervacija_ID", $Rezervacija_ID)->where("rezervacija.statusRezervacija", 0)->where("rezervacija.Korisnik_ID", "=", Auth::user()->id)->delete();
        if ($rezervacijaUspela != null && $rezervacijaUspela > 0) {
            $podaci = [];
            $podaci["naslov"] = "Uspešno ste obrisali rezervaciju";
            $podaci["poruka"] = "Vaša rezervacija je uspešno obrisana";
            $podaci["greska"] = false;
        } else {
            $podaci["naslov"] = "Rezervacija nije obrisana";
            $podaci["poruka"] = "Došlo je do greške prilikom brisanja";
            $podaci["greska"] = true;
        }


        return redirect('/userAccount/korisnickeRezervacije')->with("porukaUspeh", $podaci);
    }

    public function kontaktiraj()
    {
        return view('prodaja.contact');
    }

    public function proslediPoruku()
    {

        $attributes = request()->validate(
            [

                "message" => ["required"],
                "email" => ["required", "email"]

            ],
            [
                "message.required" => "Morate uneti zeljenu poruku!",
                "email.required" => "Polje za e-mail je obavezno"
            ]
        );

        $data = [
            "email" => request("email"),
            "messageBody" => request("message")
        ];
        Mail::to('milossavic113@gmail.com')->queue(new ContactMessage($data['email'], $data['messageBody']));



        return back()->with('success', 'Poruka je poslata!');
    }


    public function kupiIgru()
    {

        $kljuc = VideoIgra::where("video_igra.Igra_ID", "=", request("igraId"))->join("kljuc", "video_igra.Igra_ID", "kljuc.Igra_ID")->where("kljuc.status", 1)->select("kljuc.Kljuc_ID")->first();
        $imeIgre = VideoIgra::where("Igra_ID", "=", request("igraId"))->select("Naziv")->first();
        $rezervacijeKorisnika = Rezervacija::where("rezervacija.Igra_ID", "=", request("igraId"))
            ->where("rezervacija.Korisnik_ID", "=", Auth::user()->id)
            ->where("rezervacija.statusRezervacija", "=", 0)
            ->orderby("Datum", "asc")
            ->first();

        Kupovina::create([
            "Korisnik_ID" => Auth::user()->id,
            "Kljuc_ID" => $kljuc->Kljuc_ID,
            "Igra_ID" => request("igraId"),
            "Datum" => now(),
            "broj_racuna" => request("broj_racuna"),
            "Cena" => request("cenaIgre")
        ]);

        Kljuc::where("Kljuc_ID", $kljuc->Kljuc_ID)->update(["Status" => 0]);

        if (request("sacuvajKarticu") != null) {
            User::where("id", Auth::user()->id)->update(["broj_racuna" => request("broj_racuna")]);
        }

        if ($rezervacijeKorisnika != null) {
            Rezervacija::where("rezervacija.Rezervacija_ID", "=", $rezervacijeKorisnika->Rezervacija_ID)->update(["statusRezervacija" => 1]);
            $sveRezervacije = Rezervacija::where("rezervacija.Korisnik_ID", "=", Auth::user()->id)->where("rezervacija.statusRezervacija", "=", 0)->exists();
            // dd($sveRezervacije);
            if (!$sveRezervacije) {
                User::where("users.id", "=", Auth::user()->id)->update(["users.statusRezerKorisnika" => 0]);
            }
        }


        return redirect('/userAccount');
    }

    public function rezervacija()
    {
        $kljuc = VideoIgra::where("video_igra.Igra_ID", "=", request("igraId"))->select("video_igra.Igra_ID")->first();
        Rezervacija::create([
            "Igra_ID" => $kljuc->Igra_ID,
            "Korisnik_ID" => Auth::user()->id
        ]);

        return redirect('/userAccount/korisnickeRezervacije');
    }
}
