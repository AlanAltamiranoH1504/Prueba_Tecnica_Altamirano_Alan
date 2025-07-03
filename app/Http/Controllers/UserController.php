<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class UserController extends Controller
{
    public function prueba()
    {
        return response()->json([
            "msg" => "Funcionando controlador de usuarios.Alan|"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        try {
            $consentID1 = $data["consent_ID1"];
            $consentID2 = null;
            $consentID3 = null;
            if ($consentID1) {
                $id1Token = bin2hex(random_bytes(15));
            }
            if ($data["consent_ID2"]) {
                $consentID2 = bin2hex(random_bytes(15));
            }
            if ($data["consent_ID3"]) {
                $consentID3 = bin2hex(random_bytes(15));
            }

            $usuarioToSave = User::create([
                "user" => $data["user"],
                "name" => $data["name"],
                "phone" => $data["phone"],
                "password" => bcrypt($data["password"]),
                "consent_ID1" => $id1Token,
                "consent_ID2" => $consentID2,
                "consent_ID3" => $consentID3,
            ]);
            return response()->json([
                "response" => true,
                "message" => "Usuario registrado",
                "id_user" => $usuarioToSave->id
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "response" => false,
                "message" => "Error en registro de usuario",
                "error" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            $userToUpdate = User::where([
                "id" => $id
            ])->first();

            $userToUpdate->user = $data["user"];
            $userToUpdate->name = $data["name"];
            $userToUpdate->phone = $data["phone"];
            $userToUpdate->password = bcrypt($data["password"]);

            $consentID2 = $data["consent_ID2"];
            $consentID3 = $data["consent_ID3"];

            //Manejo de Consent_ID2
            if ($consentID2 && $userToUpdate->consent_ID2 == null){
                $userToUpdate->consent_ID2 = bin2hex(random_bytes(15));
                $logEnableConsentID2 = Log::create([
                    "action" => "Habilitado CONSENT_ID2",
                    "user_id" => $userToUpdate->id
                ]);
            } else if (!$consentID2 && $userToUpdate->consent_ID2 != null) {
                $userToUpdate->consent_ID2 = null;
                $logDisableConsentID2 = Log::create([
                    "action" => "Deshabilitado CONSENT_ID2",
                    "user_id" => $userToUpdate->id
                ]);
            }

            //Manejo de Consent_ID3
            if ($consentID3 && $userToUpdate->consent_ID3 == null){
                $userToUpdate->consent_ID3 = bin2hex(random_bytes(15));
                $logEnableConsentID3 = Log::create([
                    "action" => "Habilitado CONSENT_ID3",
                    "user_id" => $userToUpdate->id
                ]);
            } else if (!$consentID3 && $userToUpdate->consent_ID3 != null) {
                $userToUpdate->consent_ID3 = null;
                $logDisableConsentID3 = Log::create([
                    "action" => "Deshabilitado CONSENT_ID3",
                    "user_id" => $userToUpdate->id
                ]);
            }

            $userToUpdate->save();
            return response()->json([
                "response" => true,
                "message" => "Usuario actualizado"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "response" => false,
                "message" => "Error en actualizacion de usuario"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $usuarioToDelete = User::where([
                "id" => $id
            ])->first();
            if (!$usuarioToDelete) {
                return response()->json([
                    "response" => false,
                    "message" => "Usuario no encontrado"
                ], 404);
            }
            $usuarioToDelete->delete();
            return response()->json([
                "response" => true,
                "message" => "Usuario eliminado"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "response" => false,
                "message" => "Error en eliminiacion de usuario",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
