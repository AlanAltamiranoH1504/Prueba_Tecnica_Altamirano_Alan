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
            "user" => "required|string|exists:users,user",
            "password" => "required|string"
        ];
    }

    public function messages(): array
    {
        return [
            "user.required" => "El nombre es obligatorio para generar el token",
            "user.string" => "El nombre debe ser una cadena de texto",
            "user.exists" => "El user no está registrado en la base de datos",

            "password.required" => "El password es obligatorio para generar el token",
            "password.string" => "El password debe ser una cadena de texto",
        ];
    }
}
