<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        // 1. Setup validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8'
        ]);

        // 2. Cek validator
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // 3. Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // 4. Cek keberhasilan
        if ($user){
            return response()->json([
                'status' => 201,
                'message' => 'User created successfully',
            ], 201);
        }

        // 5. Cek gagal
        return response()->json([
            'status' => 409,
            'message' => 'User failed to create'
        ], 409); // Error conflict
    }


    public function login(Request $request){
        // 1. Setup validator
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cek validator
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // 3. Get kredensial dari request
        $credentials = $request->only('email', 'password');

        // 4. Check isFailed
        if (!$token = auth()->guard('api')->attempt($credentials)){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        // 5. Cek isSuccess
        return response()->json([
            'status' => 200,
            'message' => 'Login success',
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 200);
    }
}
