<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTokenRequest extends FormRequest
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
            "name" => "required|string|exists:users,name",
            "password" => "required|string"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio para generar el token",
            "name.string" => "El nombre debe ser una cadena de texto",
            "name.exits" => "El nombre no existe registrado en la base de datos",

            "password.required" => "El password es obligatorio para generar el token",
            "password.string" => "El password debe ser una cadena de texto",
        ];
    }
}
