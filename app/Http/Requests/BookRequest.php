<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string|unique:books,title',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return [
                        'text' => 'required|string|unique:books,text',
                        'pages' => 'required|int|min:10',
                        'category' => 'required|string',
                    ] + $rules;
            case 'PUT':
                return [
                        'title' => [
                            Rule::unique('books')->ignore($this->title, 'title')
                        ],
                    ] + $rules;
            // case 'PATCH':
            case 'DELETE':
                return [
                    'gameid_id' => 'required|uuid|exists:books,id'
                ];
        }
        return $rules;
    }
}
