<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class EditRole extends FormRequest
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
            'name' => 'required|unique:roles,name,' . $this->route->parameter('id'),
            'permission' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo :attribute está vacío',
            'name.unique' => 'El campo :attribute ya está en uso',
            'permission.required' => 'El campo :attribute está vacío',
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
