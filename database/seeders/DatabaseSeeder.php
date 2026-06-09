<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Kursus;
use App\Models\Kategori;
use App\Models\Modul;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ======== USERS ========
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username'          => 'Admin Test',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'username'          => 'Super Admin',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
                'role'              => 'superadmin',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'mentor@example.com'],
            [
                'username'          => 'Mentor Test',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
                'role'              => 'mentor',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'ricardokaka@gmail.com'],
            [
                'username'          => 'Ricardo Izecson dos Santos Leite',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
                'role'              => 'mentor',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'mentee@example.com'],
            [
                'username'          => 'Mentee Test',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
                'role'              => 'mentee',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'oscarpiastri@gmail.com'],
            [
                'username'          => 'Oscar Piastri',
                'password'          => Hash::make('12345678'),
                'email_verified_at' => now(),
                'role'              => 'mentee',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'maxverstappen@gmail.com'],
            [
                'username'          => 'Max Verstappen',
                'password'          => Hash::make('12345678'),
                'email_verified_at' => now(),
                'role'              => 'mentee',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'lukamodric@gmail.com'],
            [
                'username'          => 'Luka Modric',
                'password'          => Hash::make('12345678'),
                'email_verified_at' => now(),
                'role'              => 'mentee',
                'status'            => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'priasolo@gmail.com'],
            [
                'username'          => 'Pria Solo',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
                'role'              => 'mentee',
                'status'            => 'aktif',
            ]
        );
        // ======== KATEGORI ========
        $dataKategori = [
            ['id' => 1, 'nama' => 'UI/UX Design'],
            ['id' => 2, 'nama' => 'Web Development'],
            ['id' => 3, 'nama' => 'Mobile Development'],
        ];

        foreach ($dataKategori as $kategori) {
            Kategori::updateOrCreate(['id' => $kategori['id']], $kategori);
        }

        // ======== KURSUS ========
        $dataKursus = [
            [
                'id'          => 9,
                'judul'       => 'Bootcamp UI/UX Design with Figma: Build E-Wallet',
                'kategori_id' => 1,
                'mentor_id'   => 3,
                 'deskripsi'  => 'Di kelas ini, kita akan belajar bagaimana menggunakan Jitter, sebuah tools canggih untuk membuat prototype, untuk meningkatkan kemampuan desain UX 
kita dan menciptakan pengalaman pengguna yang menarik.micro interaction adalah bagaimana kita membuat sebuah tampilan animasi yang responsif serta 
dapat membuat antarmuka digital kita terlihat hidup. Mereka sangat penting dalam melibatkan pengguna, sehingga dapat membantu mereka berinteraksi, dan
 menambahkan sentuhan khusus pada desain kita. Dengan Jitter, kita akan belajar cara membuat interaksi Desain dengan mudah dan efisien.

Selama kelas ini, kita akan mempelajari lebih dalam tentang micro interaction dalam UX, dan bagaimana hal itu mempengaruhi keterlibatan pengguna, hubungan
emosional, dan kegunaan secara keseluruhan. Kita akan menjelajahi prinsip desain, praktik terbaik, dan contoh-contoh nyata untuk membangun dasar yang kuat
sesuai dengan prinsip micro interaction.

',
                'harga'       => 299000,
                'kuota'       => 50,
                'status'      => 'publish',
                'gambar'      => 'kursus/course.png',
            ],
            [
                'id'          => 10,
                'judul'       => 'UX Design: Prototype & UI Animation with Figma',
                'kategori_id' => 1,
                'mentor_id'   => 3,
                'deskripsi'   => 'Di kelas ini, kita akan belajar bagaimana menggunakan Jitter, sebuah tools canggih untuk membuat prototype.',
                'harga'       => 0,
                'kuota'       => 100,
                'status'      => 'publish',
                'gambar'      => 'kursus/course.png',
            ],
            [
                'id'          => 11,
                'judul'       => 'Webflow Template: Tips & Trik Approve Webflow',
                'kategori_id' => 2,
                'mentor_id'   => 3,
                   'deskripsi'  => 'Di kelas ini, kita akan belajar bagaimana menggunakan Jitter, sebuah tools canggih untuk membuat prototype, untuk meningkatkan kemampuan desain UX 
kita dan menciptakan pengalaman pengguna yang menarik.micro interaction adalah bagaimana kita membuat sebuah tampilan animasi yang responsif serta 
dapat membuat antarmuka digital kita terlihat hidup. Mereka sangat penting dalam melibatkan pengguna, sehingga dapat membantu mereka berinteraksi, dan
 menambahkan sentuhan khusus pada desain kita. Dengan Jitter, kita akan belajar cara membuat interaksi Desain dengan mudah dan efisien.

Selama kelas ini, kita akan mempelajari lebih dalam tentang micro interaction dalam UX, dan bagaimana hal itu mempengaruhi keterlibatan pengguna, hubungan
emosional, dan kegunaan secara keseluruhan. Kita akan menjelajahi prinsip desain, praktik terbaik, dan contoh-contoh nyata untuk membangun dasar yang kuat
sesuai dengan prinsip micro interaction.

',
                'harga'       => 299000,
                'kuota'       => 30,
                'status'      => 'publish',
                'gambar'      => 'kursus/course.png',
            ],
            [
                'id'          => 12,
                'judul'       => 'Mastering Flutter 2.0: Membangun Aplikasi',
                'kategori_id' => 3,
                'mentor_id'   => 3,
                 'deskripsi'  => 'Di kelas ini, kita akan belajar bagaimana menggunakan Jitter, sebuah tools canggih untuk membuat prototype, untuk meningkatkan kemampuan desain UX 
kita dan menciptakan pengalaman pengguna yang menarik.micro interaction adalah bagaimana kita membuat sebuah tampilan animasi yang responsif serta 
dapat membuat antarmuka digital kita terlihat hidup. Mereka sangat penting dalam melibatkan pengguna, sehingga dapat membantu mereka berinteraksi, dan
 menambahkan sentuhan khusus pada desain kita. Dengan Jitter, kita akan belajar cara membuat interaksi Desain dengan mudah dan efisien.

Selama kelas ini, kita akan mempelajari lebih dalam tentang micro interaction dalam UX, dan bagaimana hal itu mempengaruhi keterlibatan pengguna, hubungan
emosional, dan kegunaan secara keseluruhan. Kita akan menjelajahi prinsip desain, praktik terbaik, dan contoh-contoh nyata untuk membangun dasar yang kuat
sesuai dengan prinsip micro interaction.

',

                'harga'       => 0,
                'kuota'       => 40,
                'status'      => 'publish',
                'gambar'      => 'kursus/course.png',
            ],
        ];

        foreach ($dataKursus as $kursus) {
            Kursus::updateOrCreate(['id' => $kursus['id']], $kursus);
        }

        // ======== MODUL ========
        $dataModul = [
            ['id' => 31, 'kursus_id' => 9,  'judul' => 'Pengenalan UI/UX dan Tools Figma',           'urutan' => 1, 'file' => 'modul/modul_contoh.pdf'],
            ['id' => 32, 'kursus_id' => 9,  'judul' => 'Membuat Wireframe Aplikasi E-Wallet',        'urutan' => 2, 'file' => 'modul/modul_contoh.pdf'],
            ['id' => 33, 'kursus_id' => 9,  'judul' => 'Design High Fidelity & Prototyping',         'urutan' => 3, 'file' => 'modul/modul_contoh.pdf'],
            ['id' => 34, 'kursus_id' => 12, 'judul' => 'Module 1. Instalasi Flutter dan Dart Dasar', 'urutan' => 1, 'file' => 'modul/InstalasiFlutterdanDartDasar.pdf'],
            ['id' => 35, 'kursus_id' => 12, 'judul' => 'Module 2. Membangun Layout UI (Widget)',      'urutan' => 2, 'file' => 'modul/MembangunLayoutUI(Widget).pdf'],
            ['id' => 36, 'kursus_id' => 12, 'judul' => 'Module 3. Integrasi API pada Flutter',       'urutan' => 3, 'file' => 'modul/IntegrasiAPIpadaFlutter.pdf'],
        ];

        foreach ($dataModul as $modul) {
            Modul::updateOrCreate(['id' => $modul['id']], $modul);
        }
    }
}
