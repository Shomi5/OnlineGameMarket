<x-layoutFX>
    <div class="pozicioniranjeAdmin" style="margin-top: 20px;">
        <div class="pozadinaFrejmaAdmin sirinaOkrivira" style="{{ request()->is('adminPanel') || request()->is('adminPanel/upravljanjeRezervacijama') ? "min-height: 830px;" : "margin-top:20px;"}}">
            <div class="offcanvas-body">
                <div class=centrijar>
                    <ul class="nav nav-tabs">
                        <x-nav-link href="/userAccount" :active="request()->is('userAccount')">Generalni podatci</x-nav-link>
                        <x-nav-link href="/userAccount/korisnickeRezervacije" :active="request()->is('userAccount/korisnickeRezervacije')">Vaše
                            rezervacije</x-nav-link>
                        <x-nav-link href="/userAccount/edit" :active="request()->is('userAccount/edit')">Edit profila</x-nav-link>
                        @if (Auth::user()->status == 1)
                            <x-nav-link href="/adminPanel" :active="request()->is('adminPanel')">Admin panel</x-nav-link>
                        @elseif(Auth::user()->status == 2)
                            <x-nav-link href="/adminPanel" :active="request()->is('adminPanel')">Moderator panel</x-nav-link>
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
