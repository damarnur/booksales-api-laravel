<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class BookController extends Controller
{
    // Method di book controller
    public function index(){
        $books  = Book::with('genre', 'author')->get();

        if ($books->isEmpty()){
            return response()->json([
                "status" => 404,
                "message" => "Data not found",
                "data" => $books
            ], 404);
        }
        
        // return view('books.index', ['books' => $books]); // mengirim data ke
        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $books
        ], 200);
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

    // public function show untuk menampilkan data berdasarkan id yang bersangkutan
    public function show(int $id){
        $book = Book::with('genre', 'author')->find($id);

        if (!$book){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Get detail resource",
            "data" => $book
        ], 200);
    }

    //public function update untuk mengirimkan data baru
    public function update(int $id, Request $request){
        // 1. mencari data
        $book = Book::find($id);
        
        if (!$book){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }
        
        // 2. memvalidasi data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. siapkan data yang ingin diupdate
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id
        ];

        // 4. handle image (upload dan delete image)
        if ($request->hasFile(('cover_photo'))) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            if ($book->cover_photo){
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }

        // 5. update data baru ke database
        $book->update($data);

        // 6. return response
        return response()->json([
            "status" => 200,
            "message" => "Resource updated successfully",
            "data" => $book
        ], 200);

    }

    // public function destroy untuk menghapus data berdasarkan id
    public function destroy(int $id){
        $book = Book::find($id);

        if (!$book){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ]);
        }

        $book->delete();

        if ($book->cover_photo){
            // delete dari storage
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        return response()->json([
            "status" => 200,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}