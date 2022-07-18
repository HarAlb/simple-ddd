<?php

namespace App\Api\V1\Auth\Requests;

use App\Api\Base\Request\ApiRequest;

class LoginRequest extends ApiRequest
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
            'login' => 'required|max:255',
            'password' => 'required|max:255|min:8'
        ];
    }
}
