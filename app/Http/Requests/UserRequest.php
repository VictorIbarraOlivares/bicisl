<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
    {//en la documentacion de laravel estan los request
        return [
            'name'     => 'min:8|max:27|required',
            'email'    => 'min:4|max:250|unique:users|required',
            'password' => 'min:4|max:120|required'
        ];
    }
}
