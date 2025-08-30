<x-layoutFX>
    <div class="pozicioniranje-log ">
        <form method="POST" action="/login" class="unutrasljost fh">
            @csrf
            <div class="naslov mt">
                <h1>Pristupite nalogu</h1>
                <div>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="vas_e-mail@gmail.com" required></input>
                    <x-form-error name='email' />

                    <label for="password">Šifra:</label>
                    <input type="password" name="password" placeholder="Unesite vašu lozinku" id="password"
                        required></input>
                    <x-form-error name='password' />
                    <x-form-error name='logintry' />



                    <div class="dugmeRegister">
                        <a class="text-center" type="button" href="/">Odustani</a>
                        <button type="submit">Pristupite nalogu</button>
                    </div>
        </form>

        <p class="ptex">Da li još uvek nemate nalog? <a class="reg" href="/register">Registrujte se</a></p>

    </div>


</x-layoutFX>
