# Setup
- Copiază proiectul la destinația dorită
- Instalează git de la https://git-scm.com/download/win
- Instalează composer de la https://getcomposer.org/download/
- Deschide Command Prompt și navighează în directorul proiectului
- Rulează `composer install`
- Creează o copie după fișierul `.env.example` și denumește-o `.env`
- Editează `.env` și introdu datele de conectare la baza de date
- Rulează `php artisan jwt:generate --show`
- Pune valoarea afișată în `.env` la `JWT_SECRET`.
- Rulează `php artisan migrate`
- Rulează `php artisan db:seed`

IIS necesită extensia URL Rewrite 2.0
