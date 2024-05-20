<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class RegisterFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return  [
            'name' => 'required|string|between:8,100',
            "email"=>"email|min:8|max:255|unique:users",
            "phone_number"=>"required|max:12|unique:users", //'regex:/^(?:\+84|0)?[1-9]\d{8,9}$/'
            "password"=>"required|min:8|max:255",
            "confirm_password"=>"required|same:password"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $exception = $validator->getException();
        $responseError = new Response([
            "errors"=> $validator->errors(),
            "status"=>Response::HTTP_UNPROCESSABLE_ENTITY
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
        throw (new $exception($validator,$responseError));
    }
}
