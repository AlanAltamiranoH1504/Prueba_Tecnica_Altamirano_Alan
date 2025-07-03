<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id_user" => "required|integer|exists:users,id",
            "user" => "required|string|max:50|min:5",
            "name" => "required|string|max:100|min:3",
            "phone" => "required|string|min:10|max:10",
            "password" => "required|string|min:6",
            "consent_ID2" => "boolean",
            "consent_ID3" => "boolean",
        ];
    }
    public function messages(): array
    {
        return [
            "id_user.required" => "El id del usuario es obligatorio",
            "id_user.integer" => "El id del usuario debe ser un entero",
            "id_user.exists" => "El id del usuario no existe en la base de datos",

            "user.required" => "El user es obligatorio",
            "user.string" => "El user debe ser una cadena de texto",
            "user.min" => "El user debe tener al menos 5 caracteres",
            "user.max" => "El user debe tener maximo 50 caracteres",

            "name.required" => "El nombre es obligatorio",
            "name.string" => "El nombre debe ser un texto",
            "name.min" => "El nombre debe tener al menos 3 caracteres",
            "name.max" => "El nombre debe tener maximo 100 caracteres",

            "phone.required" => "El telefono es obligatorio",
            "phone.string" => "El telefono debe ser de tipo texto",
            "phone.min" => "El telefono debe tener al menos 10 digitos",
            "phone.max" => "El telefono debe tener maximo 10 digitos",

            "password.required" => "El password es obligatorio",
            "password.string" => "El password debe ser de tipo texto",
            "password.min" => "El password debe tener al menos 6 caracteres",

            "consent_ID2.boolean" => "Consent ID2 debe ser un valor booleano",
            "consent_ID3.boolean" => "Consent ID3 debe ser un valor booleano",
        ];
    }
}
