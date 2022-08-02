<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()

    {

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'user_id' => 'required|integer|exists:users,id',
            'role'=> 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'name.require'=> 'Это поле необходимо для заполнения',
            'name.string'=> 'Это поле дложно быть строкой',
            'email.required'=> 'Это поле необходимо для заполнения',
            'email.string'=> 'Это поле дложно быть строкой',
            'email.email'=> 'ФОрмать почты должен быть__@__',
            'email.unique'=> 'Пользователь с таким email уже существует',
        ];
    }
}
