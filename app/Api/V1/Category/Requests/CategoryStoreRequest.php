<?php

namespace App\Api\V1\Category\Requests;

use App\Api\Base\Request\ApiRequest;

class CategoryStoreRequest extends ApiRequest
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
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|numeric|exists:categories,id'
        ];
    }
}
