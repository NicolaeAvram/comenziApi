<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class CreateUserRequest extends FormRequest
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
                'email'=>'required|unique:users|email:rfc',
                'password'=>'required|min:8'
             
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
            'email.unique' => 'Exista deja un utilizatorul inregistrat cu acest email.',
            'email.email' => 'Trebuie sa fie de format email.',
            'password.required' => 'Parola este obligatorie',
            'password.min' => 'Parola trebuie sa aiba minim 8 caractere'
        ];
    }
}
