<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    private $books = [
        [
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ],
        [
            'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
            'description' => 'Buku yang membahas tentang kehidupan dan filosofi hidup seseorang',
            'price' => 25000,
            'stock' => 5,
            'cover_photo' => 'sebuah_seni.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ],
        [
            'title' => 'Naruto',
            'description' => 'Buku yang membahas tentang jalan ninja seseorang',
            'price' => 30000,
            'stock' => 55,
            'cover_photo' => 'naruto.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ],
        [
            'title' => 'Laut Bercerita',
            'description' => 'Kisah seorang aktivis yang menghilang secara misterius pada masa reformasi',
            'price' => 45000,
            'stock' => 10,
            'cover_photo' => 'laut_bercerita.jpg',
            'genre_id' => 1,
            'author_id' => 4
        ],
        [
            'title' => 'Atomic Habits',
            'description' => 'Panduan membentuk kebiasaan kecil untuk perubahan besar dalam hidup',
            'price' => 50000,
            'stock' => 20,
            'cover_photo' => 'atomic_habits.jpg',
            'genre_id' => 2,
            'author_id' => 5
        ]
    ];

    // karena data dari buku private(tidak bisa asal di akses di controller), maka buatlah method untuk pemanggilan data buku
    public function getBooks(){
        return $this->books;
    }
}
