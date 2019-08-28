<?php

namespace App\Http\Requests;

use App\Task;

class AbstractTaskRequest extends AbstractModelRequest
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
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    public function model(): Task
    {
        return (new Task())->findOrFail($this->route('task'));
    }
}
