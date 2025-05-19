<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        // return view('authors.index', ['authors' => $authors]);

        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $authors
        ]);
    }
}