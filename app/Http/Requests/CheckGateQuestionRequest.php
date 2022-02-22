<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckGateQuestionRequest extends FormRequest
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



            'check_gate_id'=> 'required',

            'inspection_criteria'=> 'required',



        ];
    }

    public function messages()
    {
            return [

                'check_gate_id.required' => 'Field is required.',

                'inspection_criteria.required' => 'Field is required.',
                 ];
    }
}
