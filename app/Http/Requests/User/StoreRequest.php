<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'especialidad_id' => 'integer', 
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'tipo_documento' => 'required|string|max:50',
            'no_documento' => 'required|string|max:50|unique:users', // Asegúrate de que no_documento sea único en la tabla "usuarios"
            'telefono' => 'string|max:50',
            'email' => 'required|email|unique:users', // Asegúrate de que el email sea único en la tabla "usuarios"
            'password' => 'required|string|min:6',
            'tipo' => 'required|string|max:50',
        ];
    }
}
