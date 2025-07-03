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
                "user" => $data["user"],
            ])->first();

            if (!$userToGeneratedToken) {
                return response()->json([
                    "error" => "Usuario no encontrado"
                ], 404);
            }

            $passwordVerify = Hash::check($data["password"], $userToGeneratedToken->password);
            if ($passwordVerify) {
                $minutosExpiracionToken = config("sanctum.expiration");
                $token = $userToGeneratedToken->createToken("token")->plainTextToken;
                return response()->json([
                    "token" => $token,
                    "date_finish" => now()->addMinutes($minutosExpiracionToken)->toDateTimeString()
                ]);
            } else {
                return response()->json([
                    "msg" => "Credenciales invalidas para generacion de toke de seguridad",
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
