<x-adminKartice>
    <div class="tabelaManipulacijaKorisnika">
        <div class="dodajKorisnika" id="dodatiKorisnik">
            <h2>Dodaj korisnika</h2>
            <hr>
            <form action="/adminPanel/dodajKorisnika" id="dodajKorisnika" method="post">
                @csrf
                <label for="Ime">Korisničko ime:</label>
                <input type="text" name="Ime" placeholder="Unesite željeno ime">
                <x-form-error name='Ime' />
                
                <label for="prezime">Korisničko prezime:</label>
                <input type="text" name="prezime" placeholder="Unesite željeno prezime">
                <x-form-error name='prezime' />
    
                <label for="email">Korisnički e-mail:</label>
                <input type="text" name="email" placeholder="Unesite željeno e-mail">
                <x-form-error name='email' />
    
                <label for="password">Korisnička šifra:</label>
                <input type="password" name="password" placeholder="Unesite željenu šifru">
                <x-form-error name='password' />
    
                <label for="password_confirmation">Ponovite unešenu šifru:</label>
                <input type="password" name="password_confirmation" placeholder="Ponovite unešenju šifru">
                <x-form-error name='password_confirmation' />
    
                <label for="status">Omogućite status:</label>
                <select name="statusKorisnika" >
                    <option class="unutrasnjiOption" value="">Sve statusi</option>
                    <option class="unutrasnjiOption" value=0>Regularni status</option>
                    <option class="unutrasnjiOption" value=1>Admin status</option>
                </select>
                <x-form-error name='statusKorisnika' />
                
                <div class="potvradaDodavanjaKorisnika" id="potvrdaDodatKorisnik" style="display: {{ session('uspesno_dodavanje_korisnika') ? 'block' : 'none' }};">
                    <h2 class="por">Uspešno ste dodali korisnika</h2>
                    <p clas="spot">Svi podaci su ispravno uneseni <strong>{{ session('uspesno_dodavanje_korisnika') }}</strong></p>
                </div>
                <button type="submit" form="dodajKorisnika">Dodaj korisnika</button>
            </form>
        </div>
        <div class="editObrisiKorisnika">
            <h2>Modifikuju podatke ili obriši</h2>
            <hr>
            <div>
                <form action="/adminPanel/editKorisnika" method="get" id="editKorisnika">
                    @csrf
                    <label for="korisnik">Odaberite kog korisnika želite da modifikujete</label>
                    <select type=submit name="korisnickiEmailEdit" >
                        <option class="unutrasnjiOption" value="">Svi korisnici:</option>
                        @foreach ($korisnik as $user)
                        <option class="unutrasnjiOption" value={{ $user->id}}>{{ $user->email}}</option>
                        @endforeach
                    </select>
                    <x-form-error name="korisnickiEmailEdit"></x-form-error>
    
                    <button type="submit" form="editKorisnika" >Odaberite korisnika</button>
                </form>
    
                <form action="/adminPanel/brisanjeKorisnika" method="post" id="brisanjeKorisnika">
                    @csrf
                    @method("delete")
                    <label for="korisnik">Odaberite kog korisnika želite da obrisete</label>
                    <select type=submit name="korisnickiEmailBrisanje" >
                        <option class="unutrasnjiOption" value="">Svi korisnici:</option>
                        @foreach ($korisnik as $user)
                        <option class="unutrasnjiOption" value={{$user->id}}>{{ $user->email}}</option>
                        @endforeach
                    </select>
                    <x-form-error name="korisnickiEmailBrisanje"></x-form-error>
    
                    <label for="passwordBrisanje">Unesite vašu šifru:</label>
                    <input type="password" name="passwordBrisanje" placeholder="Unesite vašu šifru">
                    <x-form-error name="passwordBrisanje"></x-form-error>
                    <div class="potrvdaBrisanjaKorisnika" id="potvrdaObrisanKorisnik" style="display: {{ session('uspesno_obrisan_korinsik') ? 'block' : 'none' }};">
                        <h2 class="por">Uspešno ste obrisali korisnika</h2>
                        <p clas="spot">Korisnik: <strong>{{ session('uspesno_obrisan_korinsik') }}</strong></p>
                    </div>
                    <button type="submit" form="brisanjeKorisnika">Odaberite korisnika</button>
                </form>
                
            </div>
        </div>
    </div>
</x-adminKartuce>
