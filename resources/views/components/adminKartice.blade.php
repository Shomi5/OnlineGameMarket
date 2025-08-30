<x-profilAdmin-link>

    <div class="admin-offcanvas-body">
        <div class="admin-nav-container" id="adminNav">
            <ul class="admin-nav-tabs">
                @if (Auth::user()->status == 1)
                    <x-admin-link href="/adminPanel" :active="request()->is('adminPanel')">Spisak korisnika i igara</x-admin-link>
                    <x-admin-link href="/adminPanel/manipulacijaKorisnikom" :active="request()->is('adminPanel/manipulacijaKorisnikom')">Manipulacija
                        korisnicima</x-admin-link>
                    <x-admin-link href="/adminPanel/upravljanjeVideoIgrama" :active="request()->is('adminPanel/upravljanjeVideoIgrama')">Uopravljanje video
                        igrama</x-admin-link>
                    <x-admin-link href="/adminPanel/upravljanjeRezervacijama" :active="request()->is('adminPanel/upravljanjeRezervacijama')">Upravljanje rezervacijama</x-admin-link>
                @elseif(Auth::user()->status == 2)
                <x-admin-link href="/adminPanel" :active="request()->is('adminPanel')">Spisak korisnika i igara</x-admin-link>
                <x-admin-link href="/adminPanel/upravljanjeRezervacijama" :active="request()->is('adminPanel/upravljanjeRezervacijama')">Upravljanje rezervacijama</x-admin-link>
                @endif

            </ul>
        </div>
    </div>
    <div>
        {{ $slot }}
    </div>

</x-profilAdmin-link>
