<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskRequest extends FormRequest
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
            'market'=> 'required|max:20',
            'name'=>'required|max:20',
            'symbol'=>'required|max:20',
            'period'=>'required|max:20',
            'total'=>'required',
            'unit'=>'required|max:20',
            'lever'=>'required|numeric',
            'remark' => 'max:500'
        ];
    }
}
