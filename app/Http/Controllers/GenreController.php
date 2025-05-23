<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();

        if ($genres->isEmpty()){
            return response()->json([
                "status" => 404,
                "message" => "Data not found",
                "data" => $genres
            ], 200);
        }

        // return view('genres.index', ['genres' => $genres]);
        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $genres
        ], 200);
    }

    public function store(Request $request){
        // 1. validator untuk mengecek data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
        ]);


        // 2. cek validator error
        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. insert data
        $genres = Genre::create([
            'name' => $request->name,
            'description' => $request->description
        ]);


        // 5. return response
        return response()->json([
            "status" => 201,
            "message" => "Resource added successfully",
            "data" => $genres
        ], 201);
    }

    public function show(string $id){
        $genre = Genre::find($id);

        if (!$genre){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Get detail resource",
            "data" => $genre
        ], 200);
    }

    public function update(int $id, Request $request){
        $genre = Genre::find($id);

        if (!$genre){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $genre->update($data);

        return response()->json([
            "status" => 200,
            "message" => "Resource updated successfully",
            "data" => $genre
        ], 200);
    }

    public function destroy(int $id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        $genre->delete();

        return response()->json([
            "status" => 200,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}

?>