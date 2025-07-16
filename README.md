NOME DATABASE: presto2

## Palette di colori

-   Principale: #302B27;
-   Secondario: #EFE9F4;
-   Accento: #73bd61;

## Fonts

-   Titoli:
-   Testi:


Applicazione e-commerce sviluppata come progetto finale del corso Aulab.
Funzionalità principali:

Homepage con lista prodotti e filtri di ricerca

Pagina dettaglio prodotto

Login / registrazione utenti

Profilo personale con possibilità di aggiornamento dati

Dashboard revisore per approvare o rifiutare prodotti inseriti dagli utenti

Form candidatura per diventare revisore

##  🛠️ Tecnologie utilizzate
Laravel 12 (PHP 8.3)

Bootstrap (con personalizzazioni CSS)

MySQL

Livewire (per caricamento immagini multiple)

Google Vision API (per censura volti)

Libreria Watermark per brandizzare immagini

Laravel Socialite (login con Google)

Pacchetti per multilingua: Inglese, Spagnolo, Giapponese

##  ✨ Funzionalità avanzate
Caricamento immagini multiple con anteprima e possibilità di rimuovere singolarmente

Watermark automatico sulle immagini caricate

Sito multilingua (IT, EN, ES, JA)

Dashboard revisore dedicata, con possibilità di accettare/rifiutare prodotti

API Google Vision per moderazione automatica delle immagini

Sistema di filtri e ricerca per migliorare la user experience

Struttura responsive per mobile e desktop

##  Come avviare il progetto

bash
Copia
Modifica
git clone https://github.com/tuo-username/nome-progetto.git
cd nome-progetto
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
Nota: per la moderazione immagini servono le chiavi API di Google Vision, da configurare nel file .env.
composer require e npm install

##  📚 Spunti per miglioramenti futuri
Integrazione di un carrello e sistema di checkout (per ora c'è solo una dimostrazione)

Sistema di recensioni per i prodotti

Dashboard statistica per amministratori

Notifiche email per approvazione prodotti|modifica dei prodotti

## Librerie da installare

- laravel/livewire
- laravel/socialite
- intervention/image (per watermark)
- google/cloud-vision
- fontawesome
- bootstrap
- laravel/scout + teamtnt/laravel-scout-tntsearch-driver