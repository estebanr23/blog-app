<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function index() {
        return UserResource::collection(User::all());
    }
    
    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $user;
    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        /* if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => 'Las credenciales proporcionadas son incorrectas.'
            ]);
        } */

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'ok' => false,
                'errorMessage' => 'Las credenciales son incorrectas.'
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'ok' => true,
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Token eliminado correctamente.'
        ], 200);
    }

}
