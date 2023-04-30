<?php

namespace App\Http\Requests\Label;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:labels,name',
            'description' => 'nullable|string',
        ];
    }
}
