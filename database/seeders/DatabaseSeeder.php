<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Category::insert([
            [
                'kategori' => 'General',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'Front End',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'Back End',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'Database',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'Deployment',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        

        User::insert([            
            [
                'nama' => 'John Connor',
                'username' => 'johnconnor',
                'email' => 'johnconnor@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Alex Wilson',
                'username' => 'alexwilson',
                'email' => 'alexwilson@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Megan Harvey',
                'username' => 'meganharvey',
                'email' => 'meganharvey@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Smith Murphy ',
                'username' => 'smithmurphy',
                'email' => 'smithmurphy@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Anna Iverson',
                'username' => 'annaiverson',
                'email' => 'annaiverson@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tom Cruise',
                'username' => 'tomcruise',
                'email' => 'tomcruise@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'David Blaine',
                'username' => 'davidblaine',
                'email' => 'davidblaine@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        #region old data discussion

        // Discussion::insert([
        //     [
        //         'judul' => 'Test 1',
        //         'category_id' => 1,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Test 2',
        //         'category_id' => 1,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Test 3',
        //         'category_id' => 1,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Test 4',
        //         'category_id' => 1,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Test 5',
        //         'category_id' => 1,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        // Discussion::insert([
        //     [
        //         'judul' => 'Hello 1',
        //         'category_id' => 2,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Hello 2',
        //         'category_id' => 2,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Hello 3',
        //         'category_id' => 2,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Hello 4',
        //         'category_id' => 2,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'judul' => 'Hello 5',
        //         'category_id' => 2,
        //         'deskripsi' => '<div>Test</div>',
        //         'user_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
        
        #endregion

        Discussion::insert([
            [
                'judul' => 'Cara Mengatur Routing di Laravel',
                'category_id' => 3, // Back End
                'deskripsi' => '<div>Halo teman-teman, saya ingin bertanya bagaimana cara membuat routing yang rapi dan scalable di Laravel? Terima kasih!</div>',
                'user_id' => 1, // John Connor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Apa Perbedaan Flex dan Grid di CSS?',
                'category_id' => 2, // Front End
                'deskripsi' => '<div>Saya baru belajar layouting. Kapan kita sebaiknya pakai Flexbox dan kapan pakai Grid?</div>',
                'user_id' => 2, // Alex Wilson
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Cara Normalisasi Database yang Benar',
                'category_id' => 4, // Database
                'deskripsi' => '<div>Ada yang bisa jelaskan langkah-langkah normalisasi hingga 3NF secara sederhana?</div>',
                'user_id' => 3, // Megan Harvey
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Masalah Saat Deploy Laravel di Shared Hosting',
                'category_id' => 5, // Deployment
                'deskripsi' => '<div>Apakah ada yang pernah mengalami error 500 saat deploy Laravel ke hosting biasa? Tolong bantuannya ya.</div>',
                'user_id' => 4, // Smith Murphy
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tips Belajar Vue JS untuk Pemula',
                'category_id' => 2, // Front End
                'deskripsi' => '<div>Ada rekomendasi sumber belajar Vue JS yang mudah dipahami?</div>',
                'user_id' => 5, // Anna Iverson
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pengalaman Mengerjakan Proyek Laravel Besar',
                'category_id' => 1, // General
                'deskripsi' => '<div>Share pengalaman kalian saat handle proyek Laravel skala besar. Tools dan struktur seperti apa yang digunakan?</div>',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perbedaan Antara ORM dan Query Builder',
                'category_id' => 3, // Back End
                'deskripsi' => '<div>Saya bingung kapan harus pakai Eloquent ORM dan kapan lebih baik langsung pakai DB::query().</div>',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Membuat CRUD Sederhana dengan Livewire',
                'category_id' => 3, // Back End
                'deskripsi' => '<div>Ada tutorial CRUD dengan Livewire step-by-step yang direkomendasikan?</div>',
                'user_id' => 6, // Tom Cruise
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Cara Optimasi Query di MySQL',
                'category_id' => 4, // Database
                'deskripsi' => '<div>Table saya sudah terlalu besar dan query jadi lambat. Tips optimasinya apa aja?</div>',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Ngopi-ngopi Sambil Ngoding: Tools Favorit Kalian?',
                'category_id' => 1, // General
                'deskripsi' => '<div>Kalau lagi ngoding, biasanya pakai tools apa aja? Share dong biar saling belajar.</div>',
                'user_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
