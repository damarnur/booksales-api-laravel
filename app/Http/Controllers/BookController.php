<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Method di book controller
    public function index(){
        $data = new Book(); // membuat objek untuk menampung data dari buku
        $books = $data->getBooks();
        
        return view('books.index', ['books' => $books]); // mengirim data ke
    }
}

?>