<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'id' => 1,
            'name' => 'J.K. Rowling',
            'photo' => 'jk_rowling_harry_potter.jpg',
            'bio' => 'British author, best known for the Harry Potter series.'
        ]);

        Author::create([
            'id' => 2,
            'name' => 'George R.R. Martin',
            'photo' => 'george_rr_martin.jpg',
            'bio' => 'American novelist and short story writer, known for A Song of Ice and Fire.'
        ]);

        Author::create([
            'id' => 3,
            'name' => 'Isaac Asimov',
            'photo' => 'isaac_asimov.jpg',
            'bio' => 'American author and professor of biochemistry, known for his works in science fiction.'
        ]);

        Author::create([
            'id' => 4,
            'name' => 'Stephen King',
            'photo' => 'stephen_king.jpg',
            'bio' => 'American author of horror, supernatural fiction, suspense, and fantasy novels.'
        ]);

        Author::create([
            'id' => 5,
            'name' => 'Agatha Christie',
            'photo' => 'agatha_christie.jpg',
            'bio' => 'English writer known for her detective novels and short story collections.'
        ]);

        Author::create([
            'id' => 6,
            'name' => 'Tere Liye',
            'photo' => 'tere_liye.jpg',
            'bio' => 'Indonesian author known for his novels that explore themes of relationships, family, and life.'
        ]);
        
        Author::create([
            'id' => 8,
            'name' => 'Pramoedya Ananta Toer',
            'photo' => 'pramoedya.jpg',
            'bio' => 'Indonesian author of novels, short stories, essays, and histories.'
        ]);
    }
}
