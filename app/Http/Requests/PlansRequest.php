<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlansRequest extends FormRequest
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
            'market' => 'required',
            'symbol' => 'required|string',
            'total' => 'required',
            'lever' => 'required|numeric',
            'period' => 'required|string',
            'type' => 'required|string',
            'keyPrice' => 'required',
            'lowestPrice' => 'required',
            'targetPrice' => 'required',
            'breakevenPrice' => 'required'
        ];
    }
}
