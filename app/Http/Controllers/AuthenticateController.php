<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function register(Request $request) 
    {
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

        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => 'Las credenciales proporcionadas son incorrectas.'
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'res' => true,
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'res' => true,
            'message' => 'Token eliminado correctamente.'
        ], 200);
    }

}
