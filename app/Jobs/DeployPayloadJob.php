<?php

namespace App\Jobs;

use App\Deployment;

/**
 * Class DeployPayloadJob
 */
class DeployPayloadJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @param Deployment $deployment
     */
    public function __construct(Deployment $deployment)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
