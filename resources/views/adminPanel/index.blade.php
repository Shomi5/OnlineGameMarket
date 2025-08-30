<x-adminKartice>
    <div class="PozicijaTablaAdmin">

        <h2 style="margin-bottom: 10px;">Spisak korisnika</h2>
        <div class="userTable" style="width: 97%;">
            <div class="table-wrapper">
                <table class="tableAdminPanel">
                    <thead>
                        <tr>
                            <th>Korisnikička slika</th>
                            <th>Šifra korisnika</th>
                            <th>Email</th>
                            <th>Ime i prezime</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($korisnik as $kori)
                            <tr>
                                <td><img src={{ Storage::disk('images')->exists('profilPhotos/' . $kori->id . '.jpg')? asset('images/profilPhotos/' . $kori->id . '.jpg'): asset('images/profilPhotos/blankoProfil.jpg') }} alt="..."></td>
                                <td>{{ $kori->id }}</td>
                                <td>{{ $kori->email }}</td>
                                <td>{{ $kori->Ime . ' ' . $kori->prezime }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <h2 style="margin-bottom: 10px;">Spisak video igara</h2>
        <div class="userTable" style="width: 97%;">
            <div class="table-wrapper">
                <table class="tableAdminPanel">
                    <thead>
                        <tr>
                            <th>Slika igre</th>
                            <th>Šifra video igre</th>
                            <th>Naziv video igre</th>
                            <th>Cena video igre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($igre as $igra)
                            <tr>
                                <td><img src="{{ asset('images/slikeIgara/' . $igra->Naziv . '.jpg') }}"
                            style="width: 170px; border:none;" alt="..."></td>
                                <td>{{ $igra->Igra_ID }}</td>
                                <td>{{ $igra->Naziv }}</td>
                                <td>{{ $igra->Cena_Igre }} Rsd</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
  
    </x-adminKartuce>
