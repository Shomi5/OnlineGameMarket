<x-adminKartice>
    <form action="/adminPanel/updatePodataka" method="post" enctype="multipart/form-data">
        @csrf
        @method('Patch')
        <div class="OkvirFormeEdit">
            {{-- <h1 id="dimenzijeEkrana" style="color: white">edit</h1> --}}
            <div>
                <div class="formaEdita">
                    <h3>Novi podaci</h3>
                    <hr>
                    <div class="podaciEdita">
                        <label for="ime">Vaše ime:</label>
                        <input type="hidden" name="userID" value={{ $editUser->id }}>
                        <input type="text" name=ime value={{ $editUser->Ime }}>
                        <x-form-error name="ime" />

                        <label for="prezime">Vaš prezime:</label>
                        <input type="text" name=prezime value={{ $editUser->prezime }}>
                        <x-form-error name="prezime" />

                        <label for="email">Vaš e-mail:</label>
                        <input type="text" name=email value={{ $editUser->email }}>
                        <x-form-error name="email" />

                        <label for="oldPassword">Vaš password:</label>
                        <input type="password" name=oldPassword placeholder="Unesite Vaš stari password">

                        <input type="hidden" name=oldPassword_confirmation value={{ Auth::user()->password }}>
                        <x-form-error name="oldPassword" />
                        <label for="status">Korisnički status:</label>
                        <select name="statusKorisnika">
                            <option class="unutrasnjiOption" value="{{ $editUser->status }}">{{ $statusi[$editUser->status] }}</option>
                            @foreach ($statusi  as $key => $naziv )
                            @if($key != $editUser->status)
                            <option class="unutrasnjiOption" value="{{ $key }}">{{ $naziv }}</option>
                            @endif    
                            @endforeach

                        </select>
                        <x-form-error name='statusKorisnika' />

                        <label for="password">Vaša nova šifra:</label>
                        <input type="password" name=password placeholder="Unesite Vaš novi password">
                        <x-form-error name="password" />

                        <label for="confPassword">Ponovite novu šifru:</label>
                        <input type="password" name=password_confirmation placeholder="Unesite ponovo novi password">
                        <x-form-error name="password_confirmation" />
                        <div class="potvradaDodavanjaKorisnika" id="potvrdaObrisanKorisnik"
                            style="display: {{ session('uspesno_modifikovan_korinsik') ? 'block' : 'none' }};">
                            <h2 class="por">Uspešno ste dodali korisnika</h2>
                            <p clas="spot">Svi podaci su ispravno uneseni
                                <strong>{{ session('uspesno_modifikovan_korinsik') }}</strong></p>
                        </div>
                        <button type="submit">Edituj te podatke</button>
                    </div>
                </div>
            </div>

            <div class="promenaSlike">
                <h3>Nova slika</h3>
                <hr>
                <div class="pozicijaPromenaSlike">
                    <div class="pozicijaSlike">
                        <img src={{ Storage::disk('images')->exists('profilPhotos/' . $editUser->id . '.jpg') ? asset('images/profilPhotos/' . $editUser->id . '.jpg') : asset('images/profilPhotos/blankoProfil.jpg') }}
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
