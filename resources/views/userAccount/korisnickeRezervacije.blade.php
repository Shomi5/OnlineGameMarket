<x-profil-link>
    {{-- <h1 id="dimenzijeEkrana" style="color: white">Profil</h1> --}}
    <div class="podaciProfila">
        <div class="profilanSlika">
            <img src={{ Storage::disk('images')->exists('profilPhotos/' . Auth::user()->id . '.jpg') ? asset('images/profilPhotos/' . Auth::user()->id . '.jpg') : asset('images/profilPhotos/blankoProfil.jpg') }}
                alt="...">
        </div>
        <div class="profilPodatci">
            <h2>Osnovni podatci</h2>
            <label for="imePrezime">Vaše ime i prezime:</label>
            <p>{{ Auth::user()->Ime . ' ' . Auth::user()->prezime }} </p>
            <label for="email">Vaše e-mail:</label>
            <p>{{ Auth::user()->email }} </p>
        </div>
    </div>
    <div class="userTable">
        <div class="table-wrapper">
            <table class="tableAdminPanel">
                <thead>
                    <tr>
                        <th>Slika igre</th>
                        <th>Naziv igre</th>
                        <th>Email</th>
                        <th>Cena</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$rezervacije->isEmpty())
                        @foreach ($rezervacije as $rezer)
                            <tr class="klik" id="{{ $rezer->Rezervacija_ID }}">
                                <td><img src="{{ asset('images/slikeIgara/' . $rezer->Naziv . '.jpg') }}"
                                        style="width: 170px; border:none;" alt="..."></td>
                                <td>{{ $rezer->Naziv }}</td>
                                <td>{{ $rezer->email }}</td>
                                <td>
                                    {{ $rezer->Cena_Igre }} Rsd
                                </td>
                                @if ($rezer->statusRezervacija == 0)
                                    <td class="neuspeh"> Neobrađeno </td>
                                @else
                                    <td class="uspeh">Obrađeno</td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Trenutno nema rezervacija</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>

    </div>
    <article>
        @foreach ($rezervacije as $rezer)
            <div class="popup" id="{{ 'element-' . $rezer->Rezervacija_ID }}">
                <div class="popup-content" style="background-color: rgb(89 133 199 / 49%);">
                    <div>
                        <div class="naslovNarudzbe">
                            <h3>Detalji rezervacije</h3>
                        </div>
                        <div class="obradaNarudzbine">
                            <div class="prikazKljuceva">
                                <div class="row slikaKljucevi">
                                    <div>
                                        <img src="{{ asset('images/slikeIgara/' . $rezer->Naziv . '.jpg') }}"
                                            class="rounded d-block w-200"alt="...">
                                    </div>
                                </div>

                            </div>
                            <div class="prikazNarudzbine">
                                @if ($rezer->statusRezervacija == 0)
                                    <p>Status: <span class="neuspeh">Neobrađeno</span> </p>
                                @else
                                    <p>Status: <span class="uspeh">Obrađeno</span> </p>
                                @endif
                                <p>Video igra: {{ $rezer->Naziv }}</p>
                                <p>Cena video igra: {{ $rezer->Cena_Igre }} rsd</p>
                                <p>Datum i vreme naručivanja: {{ $rezer->Datum }}</p>
                                @if ($rezer->statusRezervacija == 1)
                                    <p>Datum obrade narudžbe: {{ $rezer->datumObrade }}</p>
                                @endif

                            </div>


                        </div>
                        @if ($rezer->statusRezervacija == 0)
                            <div class="naruzbinaOdustani">
                                <a href="/prodaja/rezervacijaObrada/{{ $rezer->Rezervacija_ID }}">Odustani od
                                    narudžbine</a>
                            </div>
                        @else
                            <div class="uzmiKljucIgre">
                                <a href="/userAccount">Preuzmi ključ</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach

    </article>
    <article>
        <div id="porukeUspehPopUp" class="popup {{ session('porukaUspeh') != null ? 'show' : '' }}">
            <div class="popup-content" style="background-color: rgb(89 133 199 / 49%);">
                @if (session('porukaUspeh') != null)
                    <div class="obavestenjeUspeha">
                        <h2
                            style="{{ session('porukaUspeh')['greska'] != null && session('porukaUspeh')['greska'] == true? "color: #bb1d08;text-shadow: 0px 0px 2px black;" : '' }}">
                            {{ session('porukaUspeh')['naslov'] }}</h2>
                        <p class="spot"><strong>{{ session('porukaUspeh')['poruka'] }}</strong></p>
                    </div>
                @endif
            </div>
        </div>
    </article>

</x-profil-link>
