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
    <div class="userTable">
        <div class="table-wrapper">
            <table class="tableAdminPanel">
                <thead>
                    <tr>
                        <th>Slika igre</th>
                        <th>Naziv igre</th>
                        <th>Ključ</th>
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$kupovine->isEmpty())
                    
                    @foreach ($kupovine as $kupovina)
                        <tr>
                            <td><img src="{{ asset('images/slikeIgara/' . $kupovina->Naziv . '.jpg') }}"
                            style="width: 170px; border:none;" alt="..."></td>
                            <td>{{ $kupovina->Naziv }}</td>
                            <td>{{ $kupovina->Kljuc_ID }}</td>
                            <td>{{ $kupovina->Cena }} Rsd</td>
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
    <article>
        <div id="porukeUspehPopUp"  class="popup {{ session('porukaUspeh') != null ? 'show' : '' }}">
            <div class="popup-content" style="background-color: rgb(89 133 199 / 49%);">
                @if(session('porukaUspeh') != null)
               <div class="obavestenjeUspeha">
                    <h2 class="por">{{ session('porukaUspeh')["naslov"]}}</h2>
                    <p class="spot"><strong>{{ session('porukaUspeh')["poruka"]}}</strong></p>
                </div>
                @endif
            </div>
        </div>
    </article>

</x-profil-link>
