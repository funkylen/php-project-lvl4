<?php

namespace App\Http\Requests\Label;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'unique:labels,name,' . $this->label->id,
            'description' => 'nullable|string',
        ];
    }
}
