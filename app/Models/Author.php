<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'id' => 1,
            'name' => 'Tere Liye',
            'cover_photo' => 'tere_liye.jpg'
        ],
        [
            'id' => 2,
            'name' => 'Mark Manson',
            'cover_photo' => 'mark_manson.jpg'
        ],
        [
            'id' => 3,
            'name' => 'Masashi Kishimoto',
            'cover_photo' => 'masashi_kishimoto.jpg'
        ],
        [
            'id' => 4,
            'name' => 'Leila S. Chudori',
            'cover_photo' => 'leila_s_chudori.jpg'
        ],
        [
            'id' => 5,
            'name' => 'James Clear',
            'cover_photo' => 'james_clear.jpg'
        ]
    ];

    public function getAuthors(){
        return $this->authors;
    }
}
