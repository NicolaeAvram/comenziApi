<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|min:3',
            'price'=>'required|lte:1000'
        ];
    }

          /**
    * Get the error messages for the defined validation rules.*
    * @return array
    */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Numele este obligatoriu.',
            'name.min' => 'Numele trebuie sa aiba minim 3 caractere.',
            'price.required' => 'Pretul este obligatorie',
            'price.lte' => 'Pretul trebuie sa fie mai mic sau egal cu 1000'
        ];
    }
}

