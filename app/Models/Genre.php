<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function getGenres(){
        return $this->genres;
    }

    protected $table = 'genres';
}