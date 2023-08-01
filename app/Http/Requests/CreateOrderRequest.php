<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateOrderRequest extends FormRequest
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
                'total_value'=>'required|numeric',
                'payment_method'=>'required|in:cash,card'
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
            'total_value.required' => 'Valoarea totala este obligatoriu.',
            'total_value.numeric' => 'Valoarea totala trebuie sa fie un numar.',
            
            'payment_method.required' => 'Metoda de plata este obligatorie',
            'payment_method.in' => 'Metoda de plata trebuie sa fie card sau cash'
        ];
    }
}
