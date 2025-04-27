<x-layoutFX>
    <div class="pozicioniranjeAdmin">
        <div class="pozadinaFrejmaAdmin">
            <div class="offcanvas-body">
                <div class= centrijar>
                    <ul class="nav nav-tabs">
                        <x-nav-link   href="/userAccount" :active="request()->is('userAccount')" >Generalni podatci</x-nav-link>
                        <x-nav-link  href="/userAccount/edit" :active="request()->is('userAccount/edit')">Edit profila</x-nav-link>
                        {{-- <x-nav-link href="/userAccount/rezervacije" :active="request()->is('userAccount/rezervacije')">Rezervacije</x-nav-link> --}}
                        @if (Auth::user()->status)
                            <x-nav-link href="/adminPanel" :active="request()->is('adminPanel')">Admin panel</x-nav-link>
                        @endif
                        
                      </ul>
                </div>
            </div>
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
    
</x-layoutFX>