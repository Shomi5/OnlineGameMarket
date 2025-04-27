<?php

namespace App\Http\Controllers;

use App\Models\Kljuc;
use App\Models\Kupovina;
use App\Models\VideoIgra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdajaController extends Controller
{
    public function index()
    {

        $igra = VideoIgra::join("izdavac","video_igra.izdavac_ID","=","izdavac.izdavac_ID")->select("video_igra.*","izdavac.Naziv as izdavacNaziv")->orderBy('Cena_Igre','desc')->orderBy('video_igra.Igra_ID', 'asc')->take(3)->get();
        $sveigre = VideoIgra::all();
        // dd($sviUseri); 
        return View("prodaja.index",["igra"=>$igra, "sveigre" => $sveigre]);
    }

    public function show(VideoIgra $igra)
    {
        $igrica = VideoIgra::where("video_igra.Naziv" , $igra->Naziv)->join("izdavac","video_igra.izdavac_ID","=","izdavac.izdavac_ID")->select("video_igra.*","izdavac.Naziv as izdavacNaziv")->first();
        return view('prodaja.show',["igra" => $igrica]);
    }

    public function kupiIgru()
    {

        $kljuc = VideoIgra::where("video_igra.Igra_ID","=",request("igraId"))->join("kljuc","video_igra.Igra_ID","kljuc.Igra_ID")->where("kljuc.status", 1)->select("kljuc.Kljuc_ID")->first();
        $imeIgre = VideoIgra::where("Igra_ID","=",request("igraId"))->select("Naziv")->first();

        Kupovina::create([
            "Korisnik_ID" => Auth::user()->id,
            "Kljuc_ID" => $kljuc->Kljuc_ID,
            "Datum" => now(),
            "broj_racuna" => request("broj_racuna"),
            "Cena" => request("cenaIgre")
        ]);

        Kljuc::where("Kljuc_ID",$kljuc->Kljuc_ID)->update(["Status" => 0]);

        return redirect('/userAccount');
    }

}
