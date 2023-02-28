<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlatRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titre' => 'required|min:3|max:200',
            'description' => 'required',
            'spicy_level' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'titre.required' => 'Le champs titre est obligatoire !!!!!!!!!!',
            'body.required' => 'A message is required',
        ];
    }
}
