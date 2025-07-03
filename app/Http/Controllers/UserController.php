<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

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
            $usuarioToSave = User::create([
                "name" => $data["name"],
                "phone" => $data["phone"],
                "password" => bcrypt($data["password"]),
                "consent_ID1" => true,
                "consent_ID2" => $data["consent_ID2"],
                "consent_ID3" => $data["consent_ID3"],
            ]);
            return response()->json([
                "response" => true,
                "message" => "Usuario registrado",
                "data" => $usuarioToSave->id
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

            $userToUpdate->name = $data["name"];
            $userToUpdate->phone = $data["phone"];
            $userToUpdate->password = bcrypt($data["password"]);
            $userToUpdate->consent_ID2 = $data["consent_ID2"];
            $userToUpdate->consent_ID3 = $data["consent_ID3"];
            return response()->json([
                "response" => true,
                "message" => "Usuario actualizado",
                "id_user" => $userToUpdate->id
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
