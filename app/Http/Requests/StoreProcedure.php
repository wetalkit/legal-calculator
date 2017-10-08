<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedure extends FormRequest
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
        $rules = [
            'name' => 'required'
        ];
        if(null == $this->request->get('label')) {
            $rules['items'] = 'required';
        }
        if(null == $this->request->get('formula')) {
            $rules['formulas'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Внесете назив на процедурата.',
            'items.required' => 'Потребен е барем еден параметар за оваа процедура да биде валидна.',
            'formulas.required' => 'Потребна е барем една формула за оваа процедура да биде валидна.',
        ];
    }
}
