<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@perpus.test', 'password' => 'password', 'role' => 'admin']);
        User::create(['name' => 'Dimas', 'email' => 'siswa@perpus.test', 'password' => 'password', 'role' => 'siswa', 'kelas' => 'XII RPL 2']);

        $books = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang', 'year' => 2005, 'stock' => 4],
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2014, 'stock' => 3],
            ['title' => 'Belajar Laravel', 'author' => 'Budi Raharjo', 'publisher' => 'Informatika', 'year' => 2023, 'stock' => 5],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}