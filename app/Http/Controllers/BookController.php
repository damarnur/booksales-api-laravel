<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // Method di book controller
    public function index(){
        $books  = Book::all();

        if ($books->isEmpty()){
            return response()->json([
                "status" => 404,
                "message" => "Data not found",
                "data" => $books
            ], 200);
        }
        
        // return view('books.index', ['books' => $books]); // mengirim data ke
        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $books
        ]);
    }

    public function store(Request $request){
        // 1. validator untuk mengecek data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);


        // 2. cek validator error
        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. upload image
        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        // 4. insert data
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id
        ]);


        // 5. return response
        return response()->json([
            "status" => 201,
            "message" => "Resource added successfully",
            "data" => $book
        ], 201);
    }
}