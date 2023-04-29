<?php

namespace App\Http\Requests\TaskStatus;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:task_statuses,name',
        ];
    }
}
