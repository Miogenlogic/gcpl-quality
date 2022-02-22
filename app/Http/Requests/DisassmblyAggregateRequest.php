<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisassmblyAggregateRequest extends FormRequest
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
            //'aggr_type'=> 'required',
           // 'comp_serial_no'=> 'required',
            //'arrangement_no'=> 'required',
           // 'customer_contact'=> 'required',
           // 'branch_contact'=> 'required',
            //'crc_supervisor'=> 'required',
            //'crc_job_no'=> 'required',
            'machine_smu'=> 'integer',

            'component_smu'=> 'integer',
            //'date_dispatch'=> 'required',
        ];
    }

    public function messages()
    {
            return [

//
                //'branch_job_no.required'=> 'Field is required.',
                //'aggr_type.required'=> 'Field is required.',
//                //'comp_serial_no.required'=> 'Field is required.',
//                'arrangement_no.required'=> 'Field is required.',
//                'customer_contact.required'=> 'Field is required.',
//                'branch_contact.required'=> 'Field is required.',
//                'crc_supervisor.required'=> 'Field is required.',
                //'crc_job_no.required'=> 'Field is required.',


                'machine_smu.integer'=> 'Field must be integer.',
                'component_smu.integer'=> 'Field must be integer.',

                 ];
    }
}
