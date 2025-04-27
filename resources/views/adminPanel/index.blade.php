<x-adminKartice>
    <div class="PozicijaTablaAdmin">

        <h2>Spisak korisnika</h2>
        <div class="OkvirTabeleKorisnika">
            <div class="tableHader">
                <div for="naziv">Šifra korisnika</div>
                <div for="kluc">Ime i prezime</div>
                <div for="cena">Email</div>
            </div>
            <div class="podaciTabele">
                @foreach ($korisnik as $kori)
                    <div class="jezgro">{{ $kori->id }}</div>
                    <div class="jezgro">{{ $kori->Ime . ' ' . $kori->prezime }}</div>
                    <div class="jezgro">{{ $kori->email }}</div>
                @endforeach
            </div>
        </div>


        <h2>Spisak video igara</h2>
        <div class="OkvirTabeleIgara">
            <div class="tableHader">
                <div for="naziv">Šigra video igre</div>
                <div for="kluc">Naziv video igre</div>
                <div for="cena">Cena video igre</div>
            </div>
            <div class="podaciTabele">
                @foreach ($igre as $igra)
                    <div class="jezgro">{{ $igra->Igra_ID }}</div>
                    <div class="jezgro">{{ $igra->Naziv }}</div>
                    <div class="jezgro">{{ $igra->Cena_Igre }}</div>
                @endforeach
            </div>
        </div>

    </div>
    </div>
</x-adminKartuce>
