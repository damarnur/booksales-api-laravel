<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'id' => 1,
            'title' => 'Harry Potter and the Sorcerers Stone',
            'description' => 'The first book in the Harry Potter series.',
            'price' => 25000,
            'stock' => 37,
            'cover_photo' => 'harry_potter.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ]);

        Book::create([
            'id' => 2,
            'title' => 'The Lord of the Rings',
            'description' => 'A classic fantasy novel by J.R.R. Tolkien.',
            'price' => 60000,
            'stock' => 30,
            'cover_photo' => 'the_lord_of_the_rings.jpg',
            'genre_id' => 1,
            'author_id' => 2
        ]);

        Book::create([
            'id' => 3,
            'title' => '1984',
            'description' => 'A dystopian novel by George Orwell.',
            'price' => 25000,
            'stock' => 25,
            'cover_photo' => '1984.png',
            'genre_id' => 2,
            'author_id' => 3
        ]);

        Book::create([
            'id' => 4,
            'title' => 'The Hitchhikers Guide to the Galaxy',
            'description' => 'A comedy science fiction novel by Douglas Adams.',
            'price' => 30000,
            'stock' => 20,
            'cover_photo' => 'the_hitchhikers_guide_to_the_galaxy.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ]);

        Book::create([
            'id' => 5,
            'title' => 'The Hobbit',
            'description' => 'A fantasy novel by J.R.R. Tolkien.',
            'price' => 35000,
            'stock' => 44,
            'cover_photo' => 'the_hobbit.jpg',
            'genre_id' => 1,
            'author_id' => 2
        ]);

        Book::create([
            'id' => 6,
            'title' => 'The Shining',
            'description' => 'A horror novel by Stephen King about a family staying at an isolated hotel.',
            'price' => 40000,
            'stock' => 35,
            'cover_photo' => 'the_shining.jpg',
            'genre_id' => 7,
            'author_id' => 4
        ]);
        Book::create([
            'id' => 7,
            'title' => 'Murder on the Orient Express',
            'description' => 'A detective novel by Agatha Christie featuring Hercule Poirot.',
            'price' => 35000,
            'stock' => 20,
            'cover_photo' => 'orient_express.jpg',
            'genre_id' => 5,
            'author_id' => 5
        ]);
        Book::create([
            'id' => 8,
            'title' => 'Bumi',
            'description' => 'Novel fantasi Indonesia karya Tere Liye.',
            'price' => 55000,
            'stock' => 6,
            'cover_photo' => 'bumi.jpg',
            'genre_id' => 1,
            'author_id' => 6
        ]);
        Book::create([
            'id' => 9,
            'title' => 'Laskar Pelangi',
            'description' => 'Novel inspiratif tentang perjuangan pendidikan di Indonesia.',
            'price' => 40000,
            'stock' => 45,
            'cover_photo' => 'laskar_pelangi.jpg',
            'genre_id' => 2,
            'author_id' => 8
        ]);
        Book::create([
            'id' => 10,
            'title' => 'The Great Gatsby',
            'description' => 'A novel set in the Roaring Twenties.',
            'price' => 150000,
            'stock' => 10,
            'cover_photo' => 'great_gatsby.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ]);
    }
}
