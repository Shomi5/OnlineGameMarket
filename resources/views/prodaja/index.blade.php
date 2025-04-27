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

                <div id="carouselExampleCaptions" class="carousel carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="5000">
                    <div class="carousel-indicators">
                        @foreach (range(0, $igra->count() - 1) as $indeksIgara)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $indeksIgara }}" class="{{ $indeksIgara == 0 ? 'active' : '' }}"
                                aria-label="Slide {{ $indeksIgara + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <div class="carousel-inner ">
                        @foreach ($igra as $index => $igrica)
                            <a href="/prodaja/{{ $igrica->Naziv }}" class="text-white text-decoration-none">
                                <div class="carousel-item karosel {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('images/slikeIgara/' . $igrica->Naziv . '.jpg') }}"
                                        alt="{{ $igrica->Naziv }}" class="d-block w-100">
                                    <div class="carousel-caption d-none d-md-block fontZeljeni">
                                        <h5>
                                            {{ $igrica->Naziv }}
                                        </h5>
                                        <p>Najbolje video igre samo za vas!</p>
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
    <div class="naslovIgara">
        <h2>Video igre na dohvat ruke</h2>
    </div>
    <article class="container">
        <div class="row">

            <div class="col-md-12">
                {{-- <div>
                    <h1 id="dimenzijeEkrana" style="color: white">Video igre</h1>
                </div> --}}
                <div class="container text-center">
                    <div class="row  okrvirKartice">
                        {{-- @dd($sveigre) --}}
                        @foreach ($sveigre as $indeksIgara)
                            <div class="col">
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
                    @auth
                        @if (Auth::user()->status)
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
    </article>
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
