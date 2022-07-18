<?php

namespace App\Api\V1\AuthAdmin\Requests;

use App\Api\Base\Request\ApiRequest;

class LoginAdminRequest extends ApiRequest
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
            'email' => 'required|email:rfc,dns',
            'password' => 'required|max:255|min:8'
        ];
    }
}
