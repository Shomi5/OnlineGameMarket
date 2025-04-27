<x-profil-link>
    {{-- <h1 id="dimenzijeEkrana" style="color: white">Profil</h1> --}}
    <div class="podaciProfila">
        <div class="profilanSlika">
            <img src={{ Storage::disk('images')->exists('profilPhotos/' . Auth::user()->id . '.jpg')? asset('images/profilPhotos/' . Auth::user()->id . '.jpg'): asset('images/profilPhotos/blankoProfil.jpg') }} alt="...">
        </div>
        <div class="profilPodatci">
            <h2>Osnovni podatci</h2>
            <label for="imePrezime">Vaše ime i prezime:</label>
            <p>{{ Auth::user()->Ime . ' ' . Auth::user()->prezime }} </p>
            <label for="email">Vaše e-mail:</label>
            <p>{{ Auth::user()->email }} </p>
        </div>
    </div>
    <div class="OkvirTabele">
        <div class="tableHader">
            <div for="naziv">Naziv</div>
            <div for="kluc">Kljuc</div>
            <div for="cena">Cena</div>
        </div>
        <div class="podaciTabele">
            @foreach ($kupovine as $kupovina)
                <div class="jezgro">{{ $kupovina->Naziv }}</div>
                <div class="jezgro">{{ $kupovina->Kljuc_ID }}</div>
                <div class="jezgro">{{ $kupovina->Cena }}Rsd</div>
            @endforeach
        </div>
    </div>

</x-profil-link>
