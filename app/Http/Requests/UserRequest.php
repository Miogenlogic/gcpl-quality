<?php

namespace App\Http\Requests;

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
            //'page'=> 'required|regex:/^[a-zA-Z0-9\-]+( [a-zA-Z0-9\-\s]+)*$/',
           // 'title'=> 'required|regex:/^[a-zA-Z0-9\-]+( [a-zA-Z0-9\-\s]+)*$/',


            'email'=> 'required|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'username'=> 'required',

            'password'=> 'required',

             'status'=> 'required',
            'role'=> 'required',

        ];
    }

    public function messages()
    {
            return [

                'email.required' => 'Field is required.',

                'email.regex' => 'Please enter a valid email address',
                'username.required' => 'Field is required.',
                'password.required' => 'Field is required.',
                'status.required' => 'Field is required.',
                'role.required' => 'Field is required.',
                 ];
    }
}
