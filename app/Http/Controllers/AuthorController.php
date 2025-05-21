<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        if ($authors->isEmpty()){
            return response()->json([
                "status" => 404,
                "message" => "Data not found",
                "data" => $authors
            ], 200);
        }

        // return view('authors.index', ['authors' => $authors]);
        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $authors
        ]);
    }

    public function store(Request $request){
        // 1. validator untuk mengecek data
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'bio' => 'required|string'
        ]);


        // 2. cek validator error
        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. upload image
        $image = $request->file('photo');
        $image->store('authors', 'public');

        // 4. insert data
        $author = Author::create([
            'id' => $request->id,
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio
        ]);


        // 5. return response
        return response()->json([
            "status" => 201,
            "message" => "Resource added successfully",
            "data" => $author
        ], 201);
    }
}