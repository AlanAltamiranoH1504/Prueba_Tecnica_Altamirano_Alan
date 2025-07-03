<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            "name" => "required|string|max:100|min:3",
            "phone" => "required|string|min:10|max:10|unique:users,phone",
            "password" => "required|string|min:6",
            "consent_ID1" => "required|boolean",
            "consent_ID2" => "boolean",
            "consent_ID3" => "boolean",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio",
            "name.string" => "El nombre debe ser de tipo texto",
            "name.min" => "El nombre debe tener al menos 3 caracteres",
            "name.max" => "El nombre debe tener maximo 100 caracteres",

            "phone.required" => "El telefono es obligatorio",
            "phone.string" => "El telefono debe ser de tipo texto",
            "phone.min" => "El telefono debe tener al menos 10 digitos",
            "phone.max" => "El telefono debe tener maximo 10 digitos",
            "phone.unique" => "El telefono ya se encuentra registrado por otro usuario",

            "password.required" => "El password es obligatorio",
            "password.string" => "El password debe ser de tipo texto",
            "password.min" => "El password debe tener al menos 6 caracteres",

            "consent_ID1.required" => "Consent ID1 es obligatorio",
            "consent_ID1.boolean" => "Consent ID1 debe ser un valor booleano",

            "consent_ID2.boolean" => "Consent ID2 debe ser un valor booleano",
            "consent_ID3.boolean" => "Consent ID3 debe ser un valor booleano",
        ];
    }
}
