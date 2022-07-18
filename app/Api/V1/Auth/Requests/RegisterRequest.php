<?php

namespace App\Api\V1\Auth\Requests;

use App\Api\Base\Request\ApiRequest;
/**
 * @bodyParam email string required.Example: asd@aaa.aaa
 * @bodyParam nickname string.Example: asdw2
 * @bodyParam password string required.Example: 20122aaw
 * @bodyParam password_confirmation string required.Example: 20122aaw
 */
class RegisterRequest extends ApiRequest
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
            'nickname' => 'nullable|max:128|unique:users,nickname',
            'email' => 'required|email:rfc,dns|unique:users,email|max:255',
            'password' => 'required|confirmed|max:255|min:8'
        ];
    }
}
