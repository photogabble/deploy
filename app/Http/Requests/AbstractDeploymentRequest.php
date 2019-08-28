<?php

namespace App\Http\Requests;

use App\Deployment;

class AbstractDeploymentRequest extends AbstractModelRequest
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

    public function model(): Deployment
    {
        return (new Deployment())->findOrFail($this->route('deployment'));
    }
}
