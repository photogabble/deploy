<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\AbstractProjectRequest;
use App\Project;

class CreateRequest extends AbstractProjectRequest
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

    public function model(): Project
    {
        return new Project();
    }

    public function persist(): bool
    {
        // TODO: Implement persist() method.
    }
}
