<x-adminKartice>

    <div class="tabelaManipulacijaKorisnika">
        <div class="dodajKorisnika" id="dodatiKorisnik">
            <h2>Dodaj video igru</h2>
            <hr>
            <form action="/adminPanel/dodajVideoIgru" id="dodajIgru" method="post" enctype="multipart/form-data">
                @csrf
                <div {{-- @dd(session('igra_vec_postoji')) --}}
                    style="display: {{ session('igra_vec_postoji') != null ? 'block' : 'none' }};">
                    <p class="neuspeh" style="font-size: 18px;">Igra: <strong>{{ session('igra_vec_postoji') }} već
                            postoji</strong></p>
                </div>

                <label for="naziv">Naziv video igre:</label>
                <input type="text" name="nazivIgre" placeholder="Unesite naziv video igre">
                <x-form-error name='nazivIgre' />

                <label for="izdavacIgre">Izdavač video igre:</label>
                <select name="izdavacIgre">
                    <option class="unutrasnjiOption" value="">Sve video igra</option>
                    @foreach ($izdavaci as $izdao)
                        <option class="unutrasnjiOption" value={{ $izdao->Izdavac_ID }}>{{ $izdao->Naziv }}</option>
                    @endforeach
                </select>
                <x-form-error name='izdavacIgre' />

                <label for="cena">Cena igre:</label>
                <input type="number" name="cenaIgre" placeholder="Unesite cenu igre">
                <x-form-error name='cenaIgre' />

                <label for="opisIgre">Opis video igre:</label>
                <textarea name="opisIgre" id="opisIgre" rows="8" placeholder="Unesite opis video igre po želji"></textarea>
                <x-form-error name='opisIgre' />

                <label for="password">Unesite vašu šifri:</label>
                <input type="password" name="passwordDodajIgru" placeholder="Unesite šifru">
                <x-form-error name='passwordDodajIgru' />

                <div class="dodajIgruGrid">
                    <div class="promenaSlike">
                        <div class="pozicijaPromenaSlike">
                            <div class="izborSlike">
                                <input type="file" id="fileInput" name="novaSlika" hidden>
                                <label for="fileInput" class="custom-file-label" id="slika">Izaberi sliku</label>
                                <x-form-error name="novaSlika" />
                            </div>
                        </div>

                    </div>

                    <div>
                        <button type="submit" form="dodajIgru">Dodaj video igru</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="obrisiVideoIgru " id="obrIgru">
            <h2>Obriši video igru ili dodaj ključ:</h2>
            <hr>
            <form action="/adminPanel/obrisiIgru" method="post" id="obrisiIgru">
                @csrf
                @method('delete')
                <label for="igra">Odaberite video igru:</label>
                <select name="videoIgraBrisanje">
                    <option class="unutrasnjiOption" value="">Sve video igra</option>
                    @foreach ($sveIgre as $igra)
                        <option class="unutrasnjiOption" value={{ $igra->Igra_ID }}>{{ $igra->Naziv }}</option>
                    @endforeach
                </select>
                <x-form-error name='videoIgraBrisanje' />


                <label for="password">Unesite vašu šifri:</label>
                <input type="password" name="password_vasa" placeholder="Unesite šifru">
                <x-form-error name='password_vasa' />

                <button type="submit">Obriši video igru</button>
            </form>

            <form action="/adminPanel/dodajKljuc" method="post" id="formaEdit">
                @csrf
                <label for="igra">Odaberite video igru:</label>
                <select name="videoIgra" id="videoIgra">
                    <option class="unutrasnjiOption" value="">Sve video igra</option>
                    @foreach ($sveIgre as $igra)
                        <option class="unutrasnjiOption" value={{ $igra->Igra_ID }}>{{ $igra->Naziv }}</option>
                    @endforeach
                </select>
                <x-form-error name='videoIgra' />


                <label for="kljuc">Unesite novi ključ:</label>
                <div class="unosKljuceva">
                    <input type="text" name="kljuc" id="kljuc" placeholder="xxxx-xxxx-xxxx">
                    <button class="" type="button" id="viseKljuceva"><img class="svgIkonice"
                            src="{{ asset('svg/upload-svgrepo-com.svg') }}" /></button>
                </div>
                <x-form-error name='kljuc' />
                <button type="submit" form="formaEdit">Dodaj ključ</button>
            </form>

            <form action="/adminPanel/editVideo" method="get" id="editVideoIgre">
                @csrf
                <label for="korisnik">Odaberite koju video igru želite da menjate</label>
                <select type=submit name="videoIgraEdit">
                    <option class="unutrasnjiOption" value="">Sve video igre</option>
                    @foreach ($sveIgre as $igra)
                        <option class="unutrasnjiOption" value={{ $igra->Igra_ID }}>{{ $igra->Naziv }}</option>
                    @endforeach
                </select>
                <x-form-error name="videoIgraEdit"></x-form-error>

                <button type="submit" form="editVideoIgre">Odaberite video igru</button>
            </form>

        </div>
    </div>
    <article>
        <div id="popupDodajKljuceve" class="popup {{ session('statusKljuceva') != null ? 'show' : '' }}">
            <div class="popup-content" style="background-color: rgb(89 133 199 / 50%);">
                <h3 class="naslovPanelaKljuceva">Dodavanje ključeva za video igre</h3>
                <form action="/adminPanel/listaKljuceva" method="post" id="listaKljuceva" class="formKljucevi"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="bazaSelecta">
                        <label for="igra">Odaberite video igru:</label>
                        <select name="videoIgraLista" id="videoIgraLista">
                            <option class="unutrasnjiOption" value="">Sve video igra</option>
                            @foreach ($sveIgre as $igra)
                                <option class="unutrasnjiOption" value={{ $igra->Igra_ID }}>{{ $igra->Naziv }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <x-form-error name='videoIgraLista' />
                    <div class="bazaDugmeta">
                        <div class="promenaSlike bazaDugmeta">
                            <div class="pozicijaPromenaSlike bazaDugmeta">
                                <div class="izborSlike bazaDugmeta">
                                    <input type="file" id="kljuceviFajl" name="kljuceviFajl" hidden>
                                    <label for="kljuceviFajl" class="custom-file-label bazaDugmeta"
                                        id="slika">Unesite fajl
                                        sa ključevima</label>
                                    <x-form-error name="kljuceviFajl" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <button type="submit" form="listaKljuceva">Dodajte ključeve</button>
                </form>
            </div>
        </div>
        <div id="porukePopUp" class="popup {{ session('poruka') != null ? 'show' : '' }}">
            <div class="popup-content" style="background-color: rgb(89 133 199 / 50%);">
                @if (session('poruka') != null)
                    <div>
                        <h3
                            class="{{ session('informacije')[2]['vrednost'] == 0 ? 'errorKljuceva' : 'successKljuceva' }}">
                            {{ session('poruka') }}
                        </h3>
                    </div>
                    <div class="potvdaKljucevaOsnova">
                        <div>

                            <div class="prikazStanja">

                                @foreach (session('informacije') as $informacije)
                                    <div class="celijeStatusa">
                                        <p>{{ $informacije['stanje'] }}</p>
                                        <p>{{ $informacije['vrednost'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="prikazKljuceva">
                            <div class="row slikaKljucevi">
                                <div>
                                    <img src="{{ asset('images/slikeIgara/' . session('kljuceviIgra')['Naziv'] . '.jpg') }}"
                                        class="rounded d-block w-200"alt="...">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="userTable2">
                        <div class="table-wrapper">
                            <table class="tableAdminPanel">
                                <thead>
                                    <tr>
                                        <th>Ključ</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session('uspesna_lista') != null)

                                        @foreach (session('uspesna_lista') as $listaKljuceva)
                                            <tr>
                                                <td>{{ $listaKljuceva['kljuc'] }}</td>
                                                @if ($listaKljuceva['status'] == 'Dodat')
                                                    <td class="uspeh">{{ $listaKljuceva['status'] }}</td>
                                                @elseif($listaKljuceva['status'] == 'Postoji')
                                                    <td class="neuspeh">{{ $listaKljuceva['status'] }}</td>
                                                @else
                                                    <td class="neispravan">{{ $listaKljuceva['status'] }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">Niste kupili nijednu igru do sad</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>

                    </div>
                @endif
            </div>
        </div>
    </article>
    <article>
        <div id="porukeUspehPopUp" class="popup {{ session('porukaUspeh') != null ? 'show' : '' }}">
            <div class="popup-content" style="background-color: rgb(89 133 199 / 50%);">
                @if (session('porukaUspeh') != null)
                    <div class="obavestenjeUspeha">
                        <h2 class="por">{{ session('porukaUspeh')['naslov'] }}</h2>
                        <p class="spot"><strong>{{ session('porukaUspeh')['poruka'] }}</strong></p>
                    </div>
                @endif
            </div>
        </div>
    </article>
    </x-adminKartuce>
