<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //genre diambil dari model
        Genre::create([
            'id' => 1,
            'name' => 'Fiction',
            'description' => 'A literary work based on the imagination and not necessarily on fact.'
        ]);

        Genre::create([
            'id' => 2,
            'name' => 'Non-Fiction',
            'description' => 'A literary work based on facts and real events.'
        ]);

        Genre::create([
            'id' => 3,
            'name' => 'Science Fiction',
            'description' => 'A genre that deals with imaginative and futuristic concepts.'
        ]);
        Genre::create([
            'id' => 4,
            'name' => 'Mystery',
            'description' => 'A genre that revolves around the solution of a crime or puzzle.'
        ]);
        Genre::create([
            'id' => 5,
            'name' => 'Romance',
            'description' => 'A genre that focuses on romantic relationships between characters.'
        ]);
        Genre::create([
            'id' => 6,
            'name' => 'Horror',
            'description' => 'A genre intended to scare, frighten, or disgust the reader.'
        ]);
        Genre::create([
            'id' => 7,
            'name' => 'Thriller',
            'description' => 'A genre that uses magic and other supernatural phenomena as a plot element.'
        ]);
        Genre::create([
            'id' => 8,
            'name' => 'Action',
            'description' => 'A genre featuring a lot of fast-paced scenes and physical activities.'
        ]);
        Genre::create([
            'id' => 9,
            'name' => 'Documentary',
            'description' => 'A genre presenting real events, people, and facts.'
        ]);
    }
}