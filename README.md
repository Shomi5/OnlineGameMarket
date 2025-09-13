# Online Prodaja Igara

Ovaj projekat je web-site za online prodaju video igara. Omogućava korisnicima da kupuju igre i upravljaju svojim korisničkim nalogom. Takođe, admin panel omogućava administraciju korisnika i video igara.

## Preporučeni paketi za instalaciju

1. **PHP**: 7.4 ili novija verzija
2. **Composer**: Najnovija verzija
3. **npm**: Za frontend dependecije
4. **MySQL**: Za bazu podataka

## Kako postaviti projekat lokalno

1. **Kloniraj projekat**:

   Otvori terminal u željenom direktorijumu i pokreni komandu:

   ```bash
   git clone https://github.com/tvoje-korisnicko-ime/online-prodaja-igara.git


<<<<<<< HEAD
##Kako instalirati zavisnosti:
=======
## Kako instalirati zavisnosti:
>>>>>>> fff55ca267e9da219f55a16830d9a0c2c6bc3b2a

1. composer install
2. npm install

<<<<<<< HEAD
##Promene u .env fajlu
=======
# Konfigurisanje .env fajla
## Uneti u terminal:
1. cp .env.example .env
2. php artisan key:generate 

## Promene u .env fajlu
>>>>>>> fff55ca267e9da219f55a16830d9a0c2c6bc3b2a

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_prodaja_igara ili ako promenite ime baze stavite to ime.
DB_USERNAME=root
DB_PASSWORD=

<<<<<<< HEAD
##Dodavanje baze:
=======
## Konfiguracija AI asistenta
1. Otvoriti folder AI-sertifikat
2. Zip otpakovati na lokaciji c:\ ili d:\
3. Otvoriti php.ini
4. curl.cainfo = "D:\\cacert\\cacert.pem" - Ako je na c:\ izmenite
5. openssl.cafile = "D:\\cacert\\cacert.pem" - Ako je na c:\ izmenite 

## Dodavanje baze:
>>>>>>> fff55ca267e9da219f55a16830d9a0c2c6bc3b2a
1. Otvoriti folder database-script
2. Otvoriti phpmyadmin/database
3. Napraviti bazu "online_prodaja_igara", moze i po izvoru
4. Kliknite na Import i iz foldera database-script izaberiti script za bazu.

<<<<<<< HEAD
##Testiranje sajte:
1. UserAcc:
   email: Nikodinovic_42@gmail.com
   password: Nikodinovic_42
   
3. AdminAcc:
   email: Johnson_23@gmail.com
   password: johnson_23
=======
## Testiranje sajte:
1. UserAcc:
   email: niko123@gmail.com
   password: niko1234
   
3. ModeratorAcc:
   email:dimi123@gmail.com
   password:dimi1234


## Testiranje unosa ključeva preko exela
1. Preko admin panela otvriti folder primerKljuceva
2. Izabrati koji set ključeva ćete testirati  
5. AdminAcc:
   email: admin@gmail.com
   password: aleksa1234
>>>>>>> fff55ca267e9da219f55a16830d9a0c2c6bc3b2a


