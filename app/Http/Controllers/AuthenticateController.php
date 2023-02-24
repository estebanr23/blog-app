<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function register(Request $request) 
    {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    }
}
