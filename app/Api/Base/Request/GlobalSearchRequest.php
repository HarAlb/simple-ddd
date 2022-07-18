<?php

namespace App\Api\Base\Request;

class GlobalSearchRequest extends ApiRequest
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
            'search' => 'nullable|string',
        ];
    }
}
