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


## Kako instalirati zavisnosti:

1. composer install
2. npm install

# Konfigurisanje .env fajla
## Uneti u terminal:
1. cp .env.example .env
2. php artisan key:generate 

## Promene u .env fajlu

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_prodaja_igara ili ako promenite ime baze stavite to ime.
DB_USERNAME=root
DB_PASSWORD=

## Konfiguracija AI asistenta
1. Otvoriti folder AI-sertifikat
2. Zip otpakovati na lokaciji c:\ ili d:\
3. Otvoriti php.ini
   3.1 curl.cainfo = "D:\\cacert\\cacert.pem" - Ako je na c:\ izmenite
   3.2 openssl.cafile = "D:\\cacert\\cacert.pem" - Ako je na c:\ izmenite 

## Dodavanje baze:
1. Otvoriti folder database-script
2. Otvoriti phpmyadmin/database
3. Napraviti bazu "online_prodaja_igara", moze i po izvoru
4. Kliknite na Import i iz foldera database-script izaberiti script za bazu.

## Testiranje sajte:
1. UserAcc:
   email: niko123@gmail.com
   password: niko1234
   
3. ModeratorAcc:
   email:dimi123@gmail.com
   password:dimi1234
   
5. AdminAcc:
   email: admin@gmail.com
   password: aleksa1234


