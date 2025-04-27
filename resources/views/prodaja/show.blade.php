<x-layoutFX>
    <div class="pozicioniranje2">
        <div class="col-md-12">
            <div class="container text-center text-white pozicijaElemenata">
                
                <div class="row  slikaPrikaz">
                    <div>
                        <img src="{{ asset('images/slikeIgara/' . $igra->Naziv . '.jpg') }}" class="rounded d-block w-200"alt="...">
                    </div>
                </div>
                <div class="PozicijaDugmeta">
                    <h2>{{ $igra->Naziv }}</h2>
                    @guest
                    <a class="dugmeKupovina" href="/login">
                        Kupi video igru
                    </a>
                    @endguest
                    @auth
                    
                    <form action="/prodaja" method="POST" id="formaKupi" class="hidden formaPozicija">
                        @csrf
                        <label for="broj_racuna">Broj vašeg računa:</label>
                        <input type="text" id="broj_racuna" name="broj_racuna" placeholder="00-00000000-00">
                        <div>
                            <span id="errorPoruka" class="hidden upozorenje"></span>
                        </div>
                        <input type="hidden" name="igraId" value="{{ $igra->Igra_ID }}">
                        <input type="hidden" name="cenaIgre"  value="{{ $igra->Cena_Igre }}">
                        
                        <p for="cena">Cena igre: {{ $igra->Cena_Igre }} Rsd</p>
                        
                        <button type="submit " class="formaDugme" onclick="proveri(event)">Potvrdi te kupovinu</button>
                        
                    </form>
                    {{-- id="potvrdaKupovine" style="display: {{ session('uspesna_kupovina') ? 'block' : 'none' }};"
                    <div class="potvrdaKupio">
                        <h2 class="por">Uspešno ste dodali ključ</h2>
                        <p class="spot">Uneti ključ: <strong>{{ session('uspesna_kupovina') }}</strong></p>
                    </div> --}}
                    <button type="submit" class="dugmeKupovina" id="kupiIgru" onclick="kupiIgricu()">
                        Kupite video igru
                    </button>
                    @endauth
                    
                </div>
            </div>
            
        </div>
        
    </div>
    
    
</x-layoutFX>
