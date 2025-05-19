<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Method di book controller
    public function index(){
        $books  = Book::all();
        
        // return view('books.index', ['books' => $books]); // mengirim data ke
        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $books
        ]);
    }
}