function prikaziDimenzije() {
    let sirina = window.innerWidth;
    let visina = window.innerHeight;
    document.getElementById(
        "dimenzijeEkrana"
    ).innerHTML = `Širina ekrana: ${sirina}px, Visina ekrana: ${visina}px`;
}

window.onload = prikaziDimenzije;
window.onresize = prikaziDimenzije; // Ažurira dimenzije ako se promeni veličina ekrana

function kupiIgricu() {
    var $pomeriAtribut = document.getElementById("kupiIgru");
    var $formaSkoloni = document.getElementById("formaKupi");
    var $opisIgre = document.getElementById("opisIgre");
    var $stanje = document.getElementById("stanje");

    if ($formaSkoloni.classList.contains("hidden")) {
        $formaSkoloni.classList.remove("hidden");
        $pomeriAtribut.classList.add("hidden");
        $opisIgre.classList.add("hidden");
        $stanje.classList.add("hidden");
    }
}

function proveri(event) {
    var brojRacuna = document.getElementById("broj_racuna").value.trim();
    var errorPoruka = document.getElementById("errorPoruka");
    var pattern = /^[0-9]{2}\-[0-9]{8}\-[0-9]{2}$/;
    var rezultat = brojRacuna.match(pattern);

    if (rezultat == null) {
        if (brojRacuna == "") {
            errorPoruka.innerHTML = "Unos broja računa je obavezan!!";
            errorPoruka.classList.remove("hidden");
            event.preventDefault();

            setTimeout(function () {
                errorPoruka.classList.add("hidden"); // Sakrivanje obaveštenja
            }, 3000);
        } else {
            errorPoruka.innerHTML =
                "Pogresan unešen broj racuna (XX-XXXXXXXX-XX)";
            errorPoruka.classList.remove("hidden");
            event.preventDefault();

            setTimeout(function () {
                errorPoruka.classList.add("hidden"); // Sakrivanje obaveštenja
            }, 3000);
        }
    }
}

const navEl = document.querySelector(".skrolaj");
const navBar = document.querySelector(".navbar")
window.addEventListener("scroll", function () {
    if (window.scrollY >= 56) {
        navEl.classList.add("navbar-scrolled");
    } else if (window.scrollY < 56) {
        navEl.classList.remove("navbar-scrolled");
    }

    if (window.scrollY > 600) {
        navBar.classList.add("sakri");
    } else {
        navBar.classList.remove("sakri");
    }
    
});

window.addEventListener("load", function () {
    const potvrdaPoruka = document.getElementById("potvrdaPoruka");
    if (potvrdaPoruka) {
        setTimeout(function () {
            potvrdaPoruka.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

window.addEventListener("load", function () {
    const potvrdaObrisan = document.getElementById("potvrdaObrisanaIgra");
    if (potvrdaObrisan) {
        setTimeout(function () {
            potvrdaObrisan.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

window.addEventListener("load", function () {
    const potvrdaDodat = document.getElementById("potvrdaDodatKorisnik");
    if (potvrdaDodat) {
        setTimeout(function () {
            potvrdaDodat.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

window.addEventListener("load", function () {
    const potvrdaEditIgre = document.getElementById("potvrdaEditovanaIgra");
    if (potvrdaEditIgre) {
        setTimeout(function () {
            potvrdaEditIgre.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

window.addEventListener("load", function () {
    const potvrdaBrisanKorisnik = document.getElementById(
        "potvrdaObrisanKorisnik"
    );
    if (potvrdaBrisanKorisnik) {
        setTimeout(function () {
            potvrdaBrisanKorisnik.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

window.addEventListener("load", function () {
    const potvrdaDodatIgra = document.getElementById("potvrdaDodatIgra");
    if (potvrdaDodatIgra) {
        setTimeout(function () {
            potvrdaDodatIgra.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

window.addEventListener("load", function () {
    var potvrdaModif = document.getElementById("potvrdaModifikacija");
    if (potvrdaModif) {
        setTimeout(function () {
            potvrdaModif.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde

        //   setTimeout(function () { && potvrdaModif.style.display === "block"
        //     window.location.href = "/manipulacijaKorisnikom";  // URL na koji želiš da preusmeriš korisnika
        // }, 4000);
    }
});

window.addEventListener("load", function () {
    const potvrdaKupio = document.getElementById("potvrdaKupovine");
    if (potvrdaKupio) {
        setTimeout(function () {
            potvrdaKupio.style.display = "none";
        }, 3000); // Sakrij poruku nakon 3 sekunde
    }
});

document.addEventListener("DOMContentLoaded", function () {
    let uspesnaPoruka = document.getElementById("uspesnaKupovina");

    if (uspesnaPoruka) {
        setTimeout(function () {
            uspesnaPoruka.style.display = "none";
        }, 5000);
    }
});

function dodajKljuc() {
    var ododajKljuc = document.getElementById("dodajKljucNovi");

    if (ododajKljuc.classList.contains("hidden")) {
        ododajKljuc.classList.remove("hidden");
    } else {
        ododajKljuc.classList.add("hidden");
    }
}

function obrisiIgru() {
    var ododajKljuc = document.getElementById("obrIgru");

    if (ododajKljuc.classList.contains("hidden")) {
        ododajKljuc.classList.remove("hidden");
    } else {
        ododajKljuc.classList.add("hidden");
    }
}

function dodajKorisnika() {
    var ododajKljuc = document.getElementById("dodatiKorisnik");

    if (ododajKljuc.classList.contains("hidden")) {
        ododajKljuc.classList.remove("hidden");
    } else {
        ododajKljuc.classList.add("hidden");
    }
}
