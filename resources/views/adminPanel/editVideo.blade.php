<x-adminKartice>
    <form action="/adminPanel/updateVideoIgre" method="post" enctype="multipart/form-data">
        @csrf
        @method('Patch')
        <div class="OkvirFormeEdit">
            {{-- <h1 id="dimenzijeEkrana" style="color: white">edit</h1> --}}
            <div>
                <div class="formaEdita">
                    <h3>Nova video igra</h3>
                    <hr>
                    <div class="podaciEdita">
                        <label for="sifra">Šifra igre:</label>
                        <input type="number" name="sifra" value="{{ $editIgra->Igra_ID }}" readonly>
                        <x-form-error name='sifra' />
                        <label for="naziv">Naziv video igre:</label>
                        <input type="text" name="nazivIgre" value="{{ $editIgra->Naziv }}"">
                        <x-form-error name='nazivIgre' />

                        <label for="izdavacIgre">Izdavač video igre:</label>
                        <select name="izdavacIgre">
                            <option class="unutrasnjiOption" value="{{ $izdavaci->Izdavac_ID }}">{{ $izdavaci->Naziv }}
                            </option>
                            @foreach ($izdavaciNije as $izdao)
                                <option class="unutrasnjiOption" value="{{ $izdao->Izdavac_ID }}">{{ $izdao->Naziv }}
                                </option>
                            @endforeach
                        </select>
                        <x-form-error name='izdavacIgre' />

                        <label for="cena">Cena igre:</label>
                        <input type="number" name="cenaIgre" value="{{ $editIgra->Cena_Igre }}">
                        <x-form-error name='cenaIgre' />

                        <label for="password">Unesite vašu šifru:</label>
                        <input type="password" name="passwordDodajIgru" placeholder="Unesite šifru">
                        <x-form-error name='passwordDodajIgru' />

                        <div class="potvradaDodavanjaKorisnika" id="potvrdaObrisanKorisnik"
                            style="display: {{ session('uspesno_modifikovan_korinsik') ? 'block' : 'none' }};">
                            <h2 class="por">Uspešno ste dodali korisnika</h2>
                            <p clas="spot">Svi podaci su ispravno uneseni
                                <strong>{{ session('uspesno_modifikovan_korinsik') }}</strong></p>
                        </div>
                        <button type="submit">Editujte podatke</button>
                    </div>
                </div>
            </div>

            <div class="promenaSlike">
                <h3>Nova slika</h3>
                <hr>
                <div class="pozicijaPromenaSlike">
                    <div class="slikaVideoIgra">
                        <img src="{{ Storage::disk('images')->exists('slikeIgara/' . $editIgra->Naziv . '.jpg')
                            ? asset('images/slikeIgara/' . $editIgra->Naziv . '.jpg')
                            : asset('images/profilPhotos/blankoProfil.jpg') }}"
                            alt="...">
                    </div>
                    <div class="izborSlike">
                        <input type="file" id="fileInput" name="novaSlika" hidden>
                        <label for="fileInput" class="custom-file-label">Izaberi sliku</label>
                        <x-form-error name="novaSlika" />
                    </div>
                </div>

            </div>

        </div>
    </form>

</x-adminKartice>
