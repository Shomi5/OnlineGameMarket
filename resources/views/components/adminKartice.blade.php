<x-profilAdmin-link>

    <div class="admin-offcanvas-body">
        <div class="admin-nav-container" id="adminNav">
            <ul class="admin-nav-tabs">
                <x-admin-link   href="/adminPanel" :active="request()->is('adminPanel')" >Spisak korisnika i igara</x-admin-link>
                <x-admin-link  href="/adminPanel/manipulacijaKorisnikom" :active="request()->is('adminPanel/manipulacijaKorisnikom')">Manipulacija korisnicima</x-admin-link>
                <x-admin-link href="/adminPanel/upravljanjeVideoIgrama" :active="request()->is('adminPanel/upravljanjeVideoIgrama')">Uopravljanje video igrama</x-admin-link>
                <x-admin-link href="/adminPanel/upravljanjePromocijama" :active="request()->is('adminPanel/upravljanjePromocijama')">Uopravljanje promocijama</x-admin-link>
              </ul>
        </div>
    </div>
    <div>
        {{ $slot }}
    </div>
    
</x-profilAdmin-link>
    
