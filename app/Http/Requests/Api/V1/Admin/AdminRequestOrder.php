<?php

namespace App\Http\Requests\API\V1\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class AdminRequestOrder extends FormRequest
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
        return [
            "status_order"=> Rule::in(['0','1',"2","3","4","5"])
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
