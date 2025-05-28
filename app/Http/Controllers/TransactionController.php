<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(){
        $transactions  = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()){
            return response()->json([
                "status" => 404,
                "message" => "Data not found",
                "data" => $transactions
            ], 404);
        }
        

        return response()->json([
            "status" => 200,
            "message" => "Get all resources",
            "data" => $transactions
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $uniqueCode = "ORD-" . strtoupper(uniqid());

        $user = auth('api')->user();

        if (!$user){
            return response()->json([
                "status" => 401,
                "message" => "Unauthorized"
            ], 401);
        }

        $book = Book::find($request->book_id);

        if ($book->stock < $request->quantity){
            return response()->json([
                "status" => 400,
                "message" => "Stock not enough"
            ], 400);
        }

        $totalAmount = $book->price * $request->quantity;

        $book->stock -= $request->quantity;
        $book->save();

        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            "status" => 201,
            "message" => "Transaction created successfully",
            "data" => $transactions
        ], 201);
    }

    // public function show untuk menampilkan data berdasarkan id yang bersangkutan
    public function show(int $id){
        $transactions = Transaction::with('user', 'book')->find($id);

        if (!$transactions){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Get detail resource",
            "data" => $transactions
        ], 200);
    }

    //public function update untuk mengirimkan data baru
    public function update(int $id, Request $request){
        $transactions = Transaction::find($id);

        if (!$transactions){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $book = Book::find($request->book_id);

        if ($book->stock < $request->quantity){
            return response()->json([
                "status" => 400,
                "message" => "Stock not enough"
            ], 400);
        }

        $totalAmount = $book->price * $request->quantity;

        $book->stock -= $request->quantity;
        $book->save();

        $transactions->book_id = $request->book_id;
        $transactions->total_amount = $totalAmount;
        $transactions->save();

        return response()->json([
            "status" => 200,
            "message" => "Resource updated successfully",
            "data" => $transactions
        ], 200);
    }

    public function destroy(int $id){
        $transactions = Transaction::find($id);

        if (!$transactions){
            return response()->json([
                "status" => 404,
                "message" => "Resource not found"
            ]);
        }

        $transactions->delete();

        return response()->json([
            "status" => 200,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}
