<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use \stdClass;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $fields['username'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'Type' => 'Bearer',
            'user' => $user ,
        ]);
    }

    public function logout(Request $request) {
         // Get bearer token from the request
    $accessToken = $request->bearerToken();
    
    // Get access token from database
    $token = PersonalAccessToken::findToken($accessToken);

    // Revoke token
    $token->delete();
        return response()->json(["Message" => "You logged out", "status" => 200]);
    }
}
