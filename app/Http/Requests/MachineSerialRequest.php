<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineSerialRequest extends FormRequest
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





            'serial_no'=>'required',





        ];
    }

    public function messages()
    {
        return [

            'serial_no.required' => 'Field is required.',


        ];
    }
}
