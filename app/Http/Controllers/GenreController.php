<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Membuat method untuk genre controller
    public function index(){
        $data = new Genre();
        $genres = $data->getGenres();

        return view('genres.index', ['genres' => $genres]);
    }
}
