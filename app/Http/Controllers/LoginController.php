<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(StoreLoginRequest $request){
        if (!Auth::attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token=Auth::user()->createToken('authToken')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);
    }
}
