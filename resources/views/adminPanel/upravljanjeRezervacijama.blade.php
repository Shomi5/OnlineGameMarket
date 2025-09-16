<x-adminKartice>
    <div class="PozicijaTablaAdmin">
        <h2 style="margin-bottom: 10px;">Spisak neobrađenih rezervacija</h2>
        <div class="userTable" style="width: 97%;">
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
                        @if (!$rezervacijeNeobradjenie->isEmpty())
                            @foreach ($rezervacijeNeobradjenie as $rezer)
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
                                <td colspan="6">Trenutno nema novih rezervacija</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>

        </div>


        <h2 style="margin-bottom: 10px;">Spisak obrađenih rezervacija</h2>
        <div class="userTable" style="width: 97%;">
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
                        @if (!$rezervacijeObradjene->isEmpty())
                            @foreach ($rezervacijeObradjene as $rezer)
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
                                <td colspan="6">Trenutno nema obrađenih rezervacija</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>

        </div>
    </div>


    <article>
        @foreach ($rezervacijeNeobradjenie as $rezer)
            <div class="popup" id="{{ 'element-' . $rezer->Rezervacija_ID }}">
                <div class="popup-content" style="background-color: rgb(89 133 199 / 50%);">
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
                                <p>Datum i vreme naručivanja:</br>{{ $rezer->Datum }}</p>
                                @if ($rezer->statusRezervacija == 1)
                                    <p>Datum obrade narudžbe:</br>{{ $rezer->datumObrade }}</p>
                                @endif

                            </div>


                        </div>
                        <div class="naruzbinaOdustani">
                            <a href="/adminPanel/obrisiRezervaciju/{{ $rezer->Rezervacija_ID }}">Odustani od
                                narudžbine</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </article>

    <article>
        @foreach ($rezervacijeObradjene as $rezer)
            <div class="popup" id="{{ 'element-' . $rezer->Rezervacija_ID }}">
                <div class="popup-content" style="background-color: rgb(89 133 199 / 50%);">
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
                                <p>Datum i vreme naručivanja:</br> {{ $rezer->Datum }}</p>
                                @if ($rezer->statusRezervacija == 1)
                                    <p>Datum obrade narudžbe:</br> {{ $rezer->datumObrade }}</p>
                                @endif

                            </div>


                        </div>
                        @if(Auth::user()->status == 1)
                            <div class="naruzbinaOdustani">
                                <a href="/adminPanel/obrisiRezervaciju/{{ $rezer->Rezervacija_ID }}">Obrisi korisničku narudžbinu</a>
                        </div>
                        @endif
                        

                    </div>
                </div>
            </div>
        @endforeach

    </article>
    <article>
        <div id="porukeUspehPopUp" class="popup {{ session('porukaUspeh') != null ? 'show' : '' }}">
            <div class="popup-content" style="background-color: rgb(89 133 199 / 50%);">
                @if (session('porukaUspeh') != null)
                    <div class="obavestenjeUspeha">
                        <h2 style="{{ session('porukaUspeh')['greska'] != null && session('porukaUspeh')['greska'] == true? "color: #bb1d08;text-shadow: 0px 0px 2px black;" : '' }}">
                            {{ session('porukaUspeh')['naslov'] }}</h2>
                        <p class="spot"><strong>{{ session('porukaUspeh')['poruka'] }}</strong></p>
                    </div>
                @endif
            </div>
        </div>
    </article>
    </x-adminKartuce>
