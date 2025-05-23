<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDO;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        if ($authors->isEmpty()){
            return response()->json([
                "status" => 404,
                "message" => "Data not found",
                "data" => $authors
            ], 404);
        }

        // return view('authors.index', ['authors' => $authors]);
        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request){
        // 1. validator untuk mengecek data
        $validator = Validator::make($request->all(), [
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

    public function show(int $id){
        $author = Author::find($id);

        if (!$author){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Get detail resource",
            "data" => $author
        ], 200);
    }

    public function update(int $id, Request $request){
        $author = Author::find($id);

        if (!$author){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'bio' => 'required|string',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'bio' => $request->bio
        ];

        if ($request->hasFile(('photo'))) {
            $image = $request->file('photo');
            $image->store('authors', 'public');

            if ($author->photo){
                Storage::disk('public')->delete('authors/' . $author->photo);
            }

            $data['photo'] = $image->hashName();
        }

        $author->update($data);

        return response()->json([
            "status" => 200,
            "message" => "Resource updated successfully",
            "data" => $author
        ], 200);
    }

    public function destroy(int $id){
        $author = Author::find($id);

        if (!$author){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        $author->delete();        

        if ($author->photo){
            // delete dari storage
            Storage::disk('public')->delete('authors/' . $author->photo);
        }

        return response()->json([
            "status" => 200,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}