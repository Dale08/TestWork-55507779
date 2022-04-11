<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string|unique:categories,title',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'title' => [
                            Rule::unique('categories')->ignore($this->title, 'title')
                        ]
                    ] + $rules;
            // case 'PATCH':
            case 'DELETE':
                return [
                    'gameid_id' => 'required|uuid|exists:categories,id'
                ];
        }
        return $rules;
    }
}
