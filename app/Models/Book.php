<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function getBooks(){
        return $this->books;
    }

    protected $table = 'books';
}