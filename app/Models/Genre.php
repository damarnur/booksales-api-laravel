<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'id' => 1,
            'name' => 'Fiction',
            'description' => 'A literary work based on the imagination and not necessarily on fact.'
        ],
        [
            'id' => 2,
            'name' => 'Non-Fiction',
            'description' => 'A literary work based on facts and real events.'
        ],
        [
            'id' => 3,
            'name' => 'Science Fiction',
            'description' => 'A genre that deals with imaginative and futuristic concepts.'
        ],
        [
            'id' => 5,
            'name' => 'Mystery',
            'description' => 'A genre that revolves around the solution of a crime or puzzle.'
        ],
        [
            'id' => 6,
            'name' => 'Romance',
            'description' => 'A genre that focuses on romantic relationships between characters.'
        ],
        [
            'id' => 7,
            'name' => 'Horror',
            'description' => 'A genre intended to scare, frighten, or disgust the reader.'
        ],
        [
            'id' => 9,
            'name' => 'Thriller',
            'description' => 'A genre that uses magic and other supernatural phenomena as a plot element.'
        ],
        [
            'id' => 10,
            'name' => 'Action',
            'description' => 'A genre featuring a lot of fast-paced scenes and physical activities.'
        ],
        [
            'id' => 11,
            'name' => 'Documentary',
            'description' => 'A genre presenting real events, people, and facts.'
        ]
    ];

    public function getGenres(){
        return $this->genres;
    }
}

?>