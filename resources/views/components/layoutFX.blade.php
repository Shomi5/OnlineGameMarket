<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Najpovoljnije cene igara | Najnovije igre u najkraćem roku">
    <meta name="keywords" content="Online | Prodaja | Video | Igara | Game | Vault">
    <meta name="author" content="Miloš Savić | savicmilos119@gmail.com">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabela.css') }}">
    <link rel="stylesheet" href="{{ asset('css/popUpCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminPanelKljucevi.css') }}">
</head>

<body>

    <main class="logoviOstalo" id="pozadinaLogo" style="background-size: cover;">
        <header id="pocetakNava">
            <nav class="navbar mojibar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand me-auto" href="/"><img src="{{ asset('images/logo/Logo.png') }}"
                            alt=""></a>
                    <div class="offcanvas pozadinaOffcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img
                                    src="{{ asset('images/logo/Logo.png') }}" alt=""></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            @guest
                                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3" style="padding-left: 81px;">
                                <x-nav-link href="/" :active="request()->is('/')" style="padding-bottom: 3px;"><img class="svgIkonice2"
                            src="{{ asset('svg/house-svgrepo-com.svg') }}" /></x-nav-link>
                            @endguest
                            @auth
                                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3" style="padding-left: 21px;" >
                                <x-nav-link href="/" :active="request()->is('/')" style="padding-bottom: 3px;"><img class="svgIkonice2"
                            src="{{ asset('svg/house-svgrepo-com.svg') }}" /></x-nav-link>
                            @endauth
                                {{-- <x-nav-link href="/prodaja/kontakt" :active="request()->is('prodaja/kontakt')" >Kontakt</x-nav-link> --}}
                                {{-- <x-nav-link href="/register" :active="request()->is('register')" >About</x-nav-link> --}}
                                {{-- <x-nav-link class="nav-link mx-lg-2" href="/katalog" :active="request()->is('katalog')">Katalog</x-nav-link> --}}
                                {{-- <x-nav-link class="nav-link mx-lg-2" href="/promocija" :active="request()->is('promocija')">Promocije</x-nav-link> --}}
                                {{-- <x-nav-link  href="/kontakt" >Kontakt</x-nav-link> --}}
                            </ul>
                        </div>
                    </div>
                    @guest
                        <x-dugmad-log href="/login">Ulogijte se</x-dugmad-log>
                    @endguest

                    @auth
                        <form method="post" action="/logout">
                            @csrf
                            <div class="btn-group">
                                <a type="submit" class="Ikonnica" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-video"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/userAccount">Vaš profil</a></li>
                                    <li><button class="dropdown-item" type="submit">Log out</button></li>
                                </ul>
                            </div>
                        </form>
                    @endauth

                    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </header>



        {{ $slot }}

    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/mojaScripta.js') }}"></script>
    <script src="{{ asset('js/backgroundMix.js') }}"></script>
    <script src="{{ asset('js/adminPanel.js') }}"></script>
    <script src="{{ asset('js/narudzbinePopUp.js') }}"></script>

</body>

</html>
