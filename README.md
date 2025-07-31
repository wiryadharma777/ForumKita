## ForumKita
Website ForumKita merupakan sebuah platform forum diskusi yang dibuat khusus untuk para pengguna yang ingin berbagi pengetahuan, mengajukan pertanyaan, dan berdiskusi seputar topik pemrograman. Pengguna dapat membuat diskusi, menjawab pertanyaan dari pengguna lain, serta saling membantu dalam menyelesaikan permasalahan yang berkaitan dengan coding dan teknologi.

## Environments
1. PHP 8.4.8
2. VS Code
3. Composer
4. Laragon 5.0
5. MySQL 5.7.33
6. phpMyAdmin 6.0

## Cara Instalasi
1. Download terlebih dahulu file .zip pada bagian code -> download zip.
2. Extract ke lokasi yang diinginkan.
3. Jalankan server database yang digunakan ex: MySQL melalui XAMPP, Laragon etc.
4. Buka project ke code editor, ex: VS Code etc.
6. Jalankan perintah <code><h1>composer install</h1></code>
7. Copy and rename .env.example menjadi .env
8. Jalankan perintah <code>php artisan key:generate</code>
9. Rubah .env file pada bagian DB_DATABASE sesuai yg kita inginkan, ex: website_forum.
10. Buat database sesuai dengan nama di .env pada bagian DB_DATABASE, ex: website_forum.
11. Jalankan perintah <code>php artisan migrate:fresh --seed</code> di code editor, ex: VS Code
12. Jalankan perintah <code>php artisan serve</code> di code editor, ex: VS Code
13. Buka http://127.0.0.1:8000/ pada browser yang kita gunakan, ex: Chrome, Firefox, Brave etc.
14. Website siap digunakan.