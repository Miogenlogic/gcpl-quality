<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchServiceRequest extends FormRequest
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
            'customer'=> 'required',
            //'job_no'=> 'required',
            //'component_serial_no'=> 'required',
            'component_name'=> 'required',
            //'comp_model_no'=> 'required',
            //'machine_modelno'=> 'required',
           // 'machine_serialno'=> 'required',
            'branch_name'=> 'required',
            'import_file'=> 'required',
           // 'segment'=> 'required',
           // 'import_file'=> 'required',
            'date'=> 'required',
            'machine_smu'=>'integer',
            'component_smu'=>'integer',
        ];
    }

    public function messages()
    {
            return [

                //'service_request_no.required' => 'Field is required.',
                'customer.required' => 'Field is required.',
                //'job_no.required'=> 'Field is required.',
               // 'component_serial_no.required' => 'Field is required.',
                'component_name.required' => 'Field is required.',
               // 'comp_model_no.required'=> 'Field is required.',
                //'machine_modelno.required' => 'Field is required.',
               //'machine_serialno.required'=> 'Field is required.',
                'branch_name.required' => 'Field is required.',
                 'import_file.required' => 'Field is required.',
                //'segment.required' => 'Field is required.',
               // 'branch_location.required'=> 'Field is required.',
                'date.required'=> 'Field is required.',
                // 'machine_smu.required'=> 'Field is required.',
                'machine_smu.integer'=> 'Field must be integer.',
                 //'import_file.required'=> 'Field is required.',
                'component_smu.integer'=> 'Field must be integer.',

                 ];
    }
}
