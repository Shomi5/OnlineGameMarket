<x-layout>
    <div>
        <a href=""><img src="{{ asset('images/pozadina2.jpg') }}" alt="" class="bg-image"></a>
    </div>
    <section>
        <div class="potekst">
            <div class="opisPoteksta">
                <div class="ikonica"><i class="bi bi-shield-fill-check"></i></div>
                <div class="tekstPoteksta">
                    <div class="velikaSlova">Pouzdan i siguran</div>
                    <div class="malaSlova">Korisnička podrška 24/7</div>
                </div>
            </div>

            <div class="opisPoteksta">
                <div class="ikonica"><i class="bi bi-controller"></i></div>
                <div class="tekstPoteksta">
                    <div class="velikaSlova"> Brzo do svih igara</div>
                    <div class="malaSlova">Sve najnovije igre na jednom mestu</div>
                </div>
            </div>

            <div class="opisPoteksta">
                <div class="ikonica"><i class="bi bi-cloud-arrow-down-fill"></i></div>
                <div class="tekstPoteksta">
                    <div class="velikaSlova">Kupi i igra</div>
                    <div class="malaSlova">Online dostava ključa</div>
                </div>
            </div>
        </div>
    </section>
    <article class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">

                <div id="carouselExampleCaptions" style="padding:0px 20px;" class="carousel slide carousel-fade "
                    data-bs-interval="3000" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-indicators">
                        @foreach (range(0, $igra->count() - 1) as $indeksIgara)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $indeksIgara }}" class="{{ $indeksIgara == 0 ? 'active' : '' }}"
                                aria-label="Slide {{ $indeksIgara + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <div class="carousel-inner " style="border-radius: 10px;">
                        @foreach ($igra as $index => $igrica)
                            <a href="/prodaja/{{ $igrica->Naziv }}" class="text-white text-decoration-none">
                                <div class="carousel-item karosel {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('images/slikeIgara/' . $igrica->Naziv . '.jpg') }}"
                                        alt="{{ $igrica->Naziv }}" class="d-block w-100">
                                    <div class="carousel-caption d-none d-md-block fontZeljeni">
                                        <h5 style="font-size: 2.5rem;">
                                            {{ $igrica->Naziv }}
                                        </h5>
                                        <p style="font-size: 1.5rem;">Najbolje video igre samo za vas!</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </article>
    {{-- <div class="naslovIgara">
        <h2>Video igre na dohvat ruke</h2>
        <p class="lead">Pronađite najnovije igre i ekskluzivne naslove, odmah dostupne za kupovinu!</p>
    </div> --}}
    <article>
        <div class="najNovijeCard">
            @if (!$igraNajNovije->isEmpty())
                @foreach ($igraNajNovije as $najIgre)
                    <div class="cardUnutrasnost jumbo-div"> 
                        <a href="/prodaja/{{ $najIgre->Naziv }}" class="text-white text-decoration-none">
                           
                            <div class="formatSlikeCard">
                                 <span class="badge-novo">Nova video igra</span>
                                <img src="{{ asset('images/slikeIgara/' . $najIgre->Naziv . '.jpg') }}"
                                    class="rounded d-block w-200" alt="...">
                                <div class="noveIgreNaslov">
                                    <h5>{{ $najIgre->Naziv }}</h5>
                                    <p>Cena: {{ $najIgre->Cena_Igre }}RSD</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="naslovIgara" style="border-radius: 10px; ">
                    <h2>Trenutno nemamo igara na sajtu</h2>
                </div>
            @endif
        </div>

    </article>
    
    <div class="container" @if (request()->is('prodaja/pretraga')) id="mojElement" @endif>
        <div class="row">
            <div class="col-md-12">
                <div class="pozicijaPretrage">
                    <form action="{{ url((Request::segment(1) ?? 'prodaja') . '/pretraga') }}" method="GET"
                        id="formPretrazi" class="sortForma">
                        <div>
                            <input type="text" name="nazivIgre" placeholder="Naziv igre..">
                        </div>
                        <div>
                            <input type="number" name="maxCena" min="0"
                                value="{{ request('maxCena') != null ? request('maxCena') : '' }}"
                                placeholder="Max cena..">
                        </div>
                        <div>
                            <input type="number" name="minCena" min="0"
                                value="{{ request('minCena') != null ? request('minCena') : '' }}"
                                placeholder="Min cena..">
                        </div>
                        <div>
                            <select name="sortCena">
                                <option value="" class="unutrasnjiOption">Sortiraj po ceni</option>
                                <option value="asc" class="unutrasnjiOption"
                                    {{ request('sortCena') == 'asc' ? 'selected' : '' }}>Od najniže
                                    ka najvišoj</option>
                                <option value="desc" class="unutrasnjiOption"
                                    {{ request('sortCena') == 'desc' ? 'selected' : '' }}>Od najviše
                                    ka najnižoj</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" form="formPretrazi">Testiranje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <article class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <div>
                    <h1 id="dimenzijeEkrana" style="color: white">Video igre</h1>
                </div> --}}
    <div class="container text-center" >
        @if (!$sveigre->isEmpty())
            <div class="row  okrvirKartice">

                @foreach ($sveigre as $indeksIgara)
                    <div class="col jumbo-div">
                        <a href="/prodaja/{{ $indeksIgara->Naziv }}" class="text-white text-decoration-none">
                            <div class="text-center slikaFormat">
                                <img src="{{ asset('images/slikeIgara/' . $indeksIgara->Naziv . '.jpg') }}"
                                    class="rounded d-block w-200" alt="...">
                                <div class="opisIgre">
                                    <p class="nazivIgre">{{ $indeksIgara->Naziv }}</p>
                                    <p class="cenaIgre">{{ $indeksIgara->Cena_Igre }}RSD</p>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        @else
            <div class="naslovIgara" style="border-radius: 10px; ">
                <h2>Nemamo takvu video igru trenutno na stanju</h2>
            </div>
        @endif
        @auth
            @if (Auth::user()->status == 1)
                <div class="kreirajIgru">
                    <a href="/adminPanel/upravljanjeVideoIgrama" class="text-white text-decoration-none">
                        <div class="plusic">

                            <i class="bi bi-plus"></i>

                        </div>
                    </a>
                </div>
            @endif
        @endauth
    </div>
    </div>
    </div>
    </article> --}}
    @if ($omoguceneRezervacije != null)
        <article>
            <div id="popupOverlay" class="popup {{ $Cookie == 1 ? 'show' : '' }}"
                style="border-radius: {{ Request::is('/') ? '0' : '10px' }};">
                <div class="popup-content" style="background-color: rgb(89 133 199 / 49%); width: 700px;">
                    <div class="userTable">
                        <div class="table-wrapper">
                            <div class="naruciOkvirPopUp">
                                @if ($omoguceneRezervacije->count() > 1)
                                    <h3>Vaše narudžbine su dostupe</h3>
                                @else
                                    <h3>Vaša narudžina je dostupna</h3>
                                @endif
                                <div
                                    class="pozicijaKartica swiper {{ $omoguceneRezervacije->count() == 1 ? 'klasaCentar' : '' }}">
                                    <div class="swiper-wrapper">
                                        @if (!$omoguceneRezervacije->isEmpty())
                                            @foreach ($omoguceneRezervacije as $rezerv)
                                                <div class="unutraTabelePop swiper-slide">
                                                    <a href="/prodaja/{{ $rezerv->Naziv }}">

                                                        <div class="unutraSekcije">
                                                            <img src="{{ asset('images/slikeIgara/' . $rezerv->Naziv . '.jpg') }}"
                                                                alt="...">
                                                        </div>
                                                        <div class="unutraSekcije">
                                                            <p>{{ $rezerv->Naziv }}</p>
                                                        </div>
                                                        <div class="unutraSekcije">
                                                            <p>{{ $rezerv->Cena_Igre }} Rsd</p>
                                                        </div>
                                                    </a>


                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    @endif
    <br>
    <br>
    <footer class="d-flex flex-wrap justify-content-between align-items-center px-5  border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0">© 2025 Miloš Savić | milossavic199@gmial.com</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body" href="#"><i class="bi bi-twitter"></i></a></li>
            <li class="ms-3"><a class="text-body" href="#"><i class="bi bi-instagram"></i></a></li>
            <li class="ms-3"><a class="text-body" href="#"><i class="bi bi-facebook"></i></a></li>
        </ul>
    </footer>
</x-layout>
