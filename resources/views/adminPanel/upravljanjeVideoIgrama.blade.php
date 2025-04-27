<x-adminKartice>

    <div class="tabelaManipulacijaKorisnika">
        <div class="dodajKorisnika" id="dodatiKorisnik">
            <h2>Dodaj video igru</h2>
            <hr>
            <form action="/adminPanel/dodajVideoIgru" id="dodajIgru" method="post" enctype="multipart/form-data">
                @csrf
                <label for="sifra">Šifra igre:</label>
                <input type="number" name="sifra" placeholder="Unesite željenu šifru za igru">
                <x-form-error name='sifra' />

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
    
                <label for="password">Unesite vašu šifri:</label>
                <input type="password" name="passwordDodajIgru" placeholder="Unesite šifru">
                <x-form-error name='passwordDodajIgru' />
                
                <div class="promenaSlike">
                    <div class="pozicijaPromenaSlike">
                        <div class="izborSlike">
                            <input type="file" id="fileInput" name="novaSlika" hidden>
                            <label for="fileInput" class="custom-file-label" id="slika">Izaberi sliku</label>
                            <x-form-error name="novaSlika" />
                        </div>
                    </div>
    
                </div>

                <div class="potvradaDodavanjaKorisnika" id="potvrdaDodatIgra" style="display: {{ session('uspesno_unta_igra') ? 'block' : 'none' }};">
                    <h2 class="por">Uspešno ste dodali video igru</h2>
                    <p clas="spot">Naziv igre je: <strong>{{ session('uspesno_unta_igra') }}</strong></p>
                </div>
                <button type="submit" form="dodajIgru">Dodaj video igru</button>
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
               
                <div class="potvradaBrisanja" id="potvrdaObrisanaIgra" style="display: {{ session('uspesno_obrisana') ? 'block' : 'none' }};">
                    <h2 class="por">Uspešno ste obrisali video igru</h2>
                    <p clas="spot">Obrisana video igra: <strong>{{ session('uspesno_obrisana') }}</strong>
                    </p>
                </div>
                <button type="submit">Obriši video igru</button>
            </form>

            <form action="/adminPanel/dodajKljuc" method="post" id="formaEdit"  >
                @csrf
                <label for="igra">Odaberite video igru:</label>
                <select name="videoIgra" id="videoIgra">
                    <option class="unutrasnjiOption" value="">Sve video igra</option>
                    @foreach ($sveIgre as $igra)
                    <option class="unutrasnjiOption" value={{ $igra->Igra_ID}}>{{ $igra->Naziv }}</option>
                    @endforeach
                </select>
                <x-form-error name='videoIgra' />
    
    
                <label for="kljuc">Unesite novi ključ:</label>
                <input type="text" name="kljuc" id="kljuc" placeholder="xxxx-xxxx-xxxx">
                <x-form-error name='kljuc' />
                
                <div class="potvradaUnosa" id="potvrdaPoruka" style="display: {{ session('uspesan_kljuc') ? 'block' : 'none' }};">
                    <h2 class="por">Uspešno ste dodali ključ</h2>
                    <p class="spot">Uneti ključ: <strong>{{ session('uspesan_kljuc') }}</strong></p>
                </div>
                <button type="submit" form="formaEdit"  >Dodaj ključ</button>
            </form>

            <form action="/adminPanel/editVideo" method="get" id="editVideoIgre">
                @csrf
                <label for="korisnik">Odaberite koju video igru želite da menjate</label>
                <select type=submit name="videoIgraEdit" >
                    <option class="unutrasnjiOption" value="">Sve video igre</option>
                    @foreach ($sveIgre as $igra)
                    <option class="unutrasnjiOption"  value={{ $igra->Igra_ID}}>{{ $igra->Naziv }}</option>
                    @endforeach
                </select>
                <x-form-error name="videoIgraEdit"></x-form-error>

                <button type="submit" form="editVideoIgre" >Odaberite video igru</button>
            </form>

        </div>
    </div>
    </x-adminKartuce>
