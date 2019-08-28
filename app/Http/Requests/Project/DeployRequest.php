<?php

namespace App\Http\Requests\Project;

use App\Deployment;
use App\Http\Requests\AbstractProjectRequest;
use App\Jobs\DeployPayloadJob;
use App\Project;

class DeployRequest extends AbstractProjectRequest
{

    /** @var array Deployment[] */
    protected $deployments = [];

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
        return (new Project())->whereUuid($this->route('project'))->firstOrFail();
    }

    public function dispatch() : array
    {
        $jobs = [];
        foreach ($this->deployments as $deployment) {
            $jobs[] = app('Illuminate\Contracts\Bus\Dispatcher')->dispatch(new DeployPayloadJob($deployment));
            //$jobs[] = dispatch(new DeployPayloadJob($deployment));
        }
        return $jobs;
    }

    /**
     * Generate deployments for
     * @return bool
     */
    public function persist(): bool
    {
        $project = $this->model();

        $environments = $project->environments()->whereBranch($this->json('ref'))->get();

        if ($environments->count() === 0) {
            return false;
        }

        foreach ($environments as $environment) {
            $deployment = new Deployment([
                'deploy_type' => Deployment::DEPLOY_AUTO,
                'delivery_id' => $this->header('X-GitHub-Delivery'),
            ]);
            $deployment->environment()->associate($environment);
            $deployment = $project->deployments()->save($deployment);

            if (! $deployment) {
                return false;
            }

            $this->deployments[] = $deployment;
        }

        return true;
    }
}
