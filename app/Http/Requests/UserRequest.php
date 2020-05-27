<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'current_password' => 'required|string|min:6',
            'new_password'     => 'nullable|string|min:6|confirmed',
            'avatar' => [
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'dimensions:min_width=100,min_height=100',
                'max:4096'
            ]
        ];
    }
}
