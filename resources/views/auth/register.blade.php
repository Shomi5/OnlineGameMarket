<x-layoutFX>
    {{-- <div>
        <h1 id="dimenzijeEkrana" style="color: white">Video igre</h1>
    </div> --}}
    <div class="pozicioniranje-regiser">
        <form method="POST" action="/register" class="unutrasljost">
            @csrf

            <div class="naslov">
                <h1>Napravite Vaš nalog</h1>
                <hr>
            </div>
            <label for="Ime">Ime:</label>
            <input name="Ime" id="Ime" :value="old('Ime')" placeholder="Upišite vaše ime" required></input>
            <x-form-error name='Ime' />

            <label for="prezime">Prezime:</label>

            <input name="prezime" :value="old('prezime')" id="prezime" placeholder="Upišite vaše prezime"
                required></input>
            <x-form-error name='prezime' />

            <label for="email">Email:</label>

            <input type="email" :value="old('email')" name="email" id="email"
                placeholder="vas_e-mail@gmail.com" required></input>
            <x-form-error name='email' />

            <label for="password">Šifra:</label>

            <input type="password" name="password" id="password" placeholder="Unesite šifru po želji" required></input>
            <x-form-error name='password' />



            <label for="password_confirmation">Ponovite šifru:</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                placeholder="Ponovite željinu šifru" required></input>
            <x-form-error name='password_confirmation' />
            <div class="dugmeRegister">
                <a class="text-center" type="button" href="/">Odustani</a>
                <button type="submit">Pristupite nalogu</button>
            </div>

        </form>
    </div>




    </x-layout2>
