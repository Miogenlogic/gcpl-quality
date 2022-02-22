<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpFormRequest extends FormRequest
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
            'password'=>'required|min:6',
            'password_confirmation'=>'required_with:password|same:password',

        ];
    }

    public function messages()
    {
            return [

                'password.required' => 'Field is required.',
                'password.min' => 'Field must be minimum 6 charecters',
                'password_confirmation.same' => 'Field must be same as password',
                'password_confirmation.required' => 'Field is required.',
                 ];
    }
}
