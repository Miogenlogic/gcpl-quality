<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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

            //'service_request_no'=> 'required',
            'name'=> 'required',
            //'job_no'=> 'required',
            //'component_serial_no'=> 'required',
            'designation_id'=> 'required',
            //'comp_model_no'=> 'required',
            'phone_no'=> 'required',
            // 'machine_serialno'=> 'required',

            'email'=> 'required',
        ];
    }

    public function messages()
    {
        return [

            //'service_request_no.required' => 'Field is required.',
            'name.required' => 'Field is required.',
            //'job_no.required'=> 'Field is required.',
            // 'component_serial_no.required' => 'Field is required.',
            'designation_id.required' => 'Field is required.',
            // 'comp_model_no.required'=> 'Field is required.',
            'phone_no.required' => 'Field is required.',
            //'machine_serialno.required'=> 'Field is required.',
            'email.required' => 'Field is required.',


        ];
    }
}
