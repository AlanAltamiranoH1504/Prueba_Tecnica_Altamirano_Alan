<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTokenRequest;
use App\Models\Token;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class TokenController extends Controller
{
    public function getToken(CreateTokenRequest $request)
    {
        $data = $request->validated();
        try {
            $userToGeneratedToken = User::where([
                "name" => $data["name"],
            ])->first();

            $passwordVerify = Hash::check($data["password"], $userToGeneratedToken->password);
            if ($passwordVerify) {
                $minutosExpiracionToken = config("sanctum.expiration");
                $token = $userToGeneratedToken->createToken("token")->plainTextToken;
                return response()->json([
                    "token" => $token,
                    "expiration" => now()->addMinutes($minutosExpiracionToken)->toDateTimeString()
                ]);
            } else {
                return response()->json([
                    "msg" => "Credenciales invalidas",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "response" => false,
                "error" => "Error en generacion de token",
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
