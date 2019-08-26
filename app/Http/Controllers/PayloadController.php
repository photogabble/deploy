<?php

namespace App\Http\Controllers;

use App\Jobs\DeployPayloadJob;
use App\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayloadController extends Controller
{
    public function actionPayload(Request $request, string $project)
    {
        //$project = Project::whereId($project)

        $event = $request->header('X-GitHub-Event');

        if ($event === 'ping') {
            return new JsonResponse(['message' => 'pong']);
        } else if ($event === 'push') {

            // @todo check X-GitHub-Delivery hasn't already got a job dispatched against it
            // @todo if this push event matches an branch that our $project has an environment configured for then dispatch a new deployment

            $archive = $request->json('repository.archive_url');
            $archive = str_replace('{archive_format}', 'archive', $archive);
            $archive = str_replace('{/ref}', $request->json('after'), $archive);

            $job = $this->dispatch(new DeployPayloadJob());

            return new JsonResponse(['message' => 'ok', 'job_id' => $job]);
        }
        return new JsonResponse(['error' => 'Unknown X-GitHub-Event value [' . $event . ']'], 422);
    }
}

// https://github.com/photogabble/deploy/archive/6544c6d4926e7ecc5583df98f71331a06e3cabf1.zip
