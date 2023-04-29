<?php

namespace App\Http\Requests\TaskStatus;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'unique:task_statuses,name',
        ];
    }
}
