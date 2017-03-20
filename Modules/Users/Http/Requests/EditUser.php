<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class EditUser extends FormRequest
{

    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'username' => 'required|min:5|unique:users,username,' . $this->route->parameter('id'),
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->route->parameter('id'),
            'role' => 'required'
        ];
    }

    /*
     *  messages in Spanish
     */
    public function messages()
    {
        return [
            'username.required' => 'El campo :attribute no puede estar vacío',
            'username.min' => 'El campo :attribute debe contener al menos 5 caracteres',
            'username.unique' => 'Ya existe un :attribute con el mismo nombre',
            'name.required' => 'El campo :attribute no puede estar vacío',
            'email.required' => 'El campo :attribute no puede estar vacío',
            'email.email' => 'El campo :attribute debe ser un email válido',
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
