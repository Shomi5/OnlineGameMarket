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


##Kako instalirati zavisnosti:

1. composer install
2. npm install

##Promene u .env fajlu

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_prodaja_igara ili ako promenite ime baze stavite to ime.
DB_USERNAME=root
DB_PASSWORD=

##Dodavanje baze:
1. Otvoriti folder database-script
2. Otvoriti phpmyadmin/database
3. Napraviti bazu "online_prodaja_igara", moze i po izvoru
4. Kliknite na Import i iz foldera database-script izaberiti script za bazu.

##Testiranje sajte:
1. UserAcc:
   email: Nikodinovic_42@gmail.com
   password: Nikodinovic_42
   
3. AdminAcc:
   email: Johnson_23@gmail.com
   password: johnson_23


