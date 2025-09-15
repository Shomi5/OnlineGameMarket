<x-layoutFX>
    <div class="pozicioniranje2">
        {{-- col-md-12 --}}
        <div class="okvirPrikazaVideoIgre">
            <div class="text-center text-white pozicijaElemenata">

                <div class="row slikaPrikaz">
                    <div>
                        <img src="{{ asset('images/slikeIgara/' . $igra->Naziv . '.jpg') }}"
                            class="rounded d-block w-200"alt="...">
                    </div>
                </div>
                <div class="PozicijaDugmeta">
                    <h2>{{ $igra->Naziv }}</h2>
                    <p id="opisIgre" class="opisIgreTekst">
                        {{ $igra->opisIgre }}
                    </p>
                    @guest

                        <a class="dugmeKupovina" href="/login">
                            Ulogujte se
                        </a>
                    @endguest
                    @auth

                        @if ($kljucIgre)
                            <div class="kupovinaOkriv">
                                <form action="/prodaja" method="POST" id="formaKupi" class="hidden formaPozicija">
                                @csrf
                                
                                <div class="podaciKupovina">
                                    <div>
                                        <label for="imePrezime">Ime i prezime:</label>
                                    <input type="text" id="imePrezime" name="imePrezime" value="{{ Auth::user()->Ime . ' ' . Auth::user()->prezime }}" readonly>
                                    </div>
                                    <div>
                                        <label for="emailUser">Vaša e-mail adresa:</label>
                                    <input type="text" id="emailUser" name="emailUser" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </div>
                                <label for="broj_racuna">Broj vašeg računa:</label>
                                @if(Auth::user()->broj_racuna != null)
                                <input type="text" id="broj_racuna" name="broj_racuna" value="{{ Auth::user()->broj_racuna }}">    
                                @else
                                <input type="text" id="broj_racuna" name="broj_racuna" placeholder="00-00000000-00"> 
                                @endif
                                
                                <div class="kvacicaZaKarticu">
                                    <input type="checkbox" id="sacuvajKarticu" name="sacuvajKarticu">
                                    <span>Sačuvajte broj računa</span>
                                </div>
                                <div>
                                    <span id="errorPoruka" class="hidden upozorenje"></span>
                                </div>
                                <input type="hidden" name="igraId" value="{{ $igra->Igra_ID }}">
                                <input type="hidden" name="cenaIgre" value="{{ $igra->Cena_Igre }}">

                                <p for="cena" class="p-drugi">Cena igre: {{ $igra->Cena_Igre }} Rsd</p>

                                <button type="submit " class="formaDugme" onclick="proveri(event)">Potvrdi te
                                    kupovinu</button>

                            </form>
                            <button type="submit" class="dugmeKupovina" id="kupiIgru" onclick="kupiIgricu()">
                                Kupite video igru
                            </button>
                            </div>
                        @else
                            <div class="kupovinaOkriv">
                                <h3 id="stanje" class="">Igra trenutno nije na stanju</h3>
                            <form action="/prodaja/rezervacijaIgre" method="POST" id="formaKupi" class="hidden formaPozicija">
                                @csrf
                                <label for="emailUser">Vaša e-mail adresa:</label>
                                <input type="text" id="emailUser" name="emailUser" value="{{ Auth::user()->email }}" readonly>
                                <input type="hidden" name="igraId" value="{{ $igra->Igra_ID }}">
                                <input type="hidden" name="cenaIgre" value="{{ $igra->Cena_Igre }}">

                                <p for="cena" class="p-drugi">Cena igre: {{ $igra->Cena_Igre }} Rsd</p>

                                <button type="submit" class="formaDugme" onclick="proveri(event)">Potvrdite
                                    rezervaciju</button>

                            </form>
                            <button type="submit" class="dugmeKupovina" id="kupiIgru" onclick="kupiIgricu()">
                                Rezervisi video igru
                            </button>
                            </div>
                        @endif
                    @endauth

                </div>
            </div>

        </div>

    </div>


</x-layoutFX>
