<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'username' => 'required|min:5|unique:users,username',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'El campo :attribute no puede estar vacío',
            'username.min' => 'El campo :attribute debe contener al menos 5 caracteres',
            'username.unique' => 'Ya existe un :attribute con el mismo nombre',
            'name.required' => 'El campo :attribute no puede estar vacío',
            'email.required' => 'El campo :attribute no puede estar vacío',
            'email.email' => 'El campo :attribute debe ser un email válido',
            'password.required' => 'El campo :attribute no debe estar vacío',
            'password.min' => 'El campo password debe tener al menos 5 caracteres',
            'role.required' => 'Debe de seleccionar al menos un Role',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
