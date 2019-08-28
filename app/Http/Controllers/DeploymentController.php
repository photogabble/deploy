<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\DeployRequest as DeployProjectRequest;
use App\Http\Requests\Deployment\ViewRequest as ViewDeploymentRequest;
use App\Http\Requests\Project\ViewRequest as ViewProjectRequest;
use Illuminate\Http\JsonResponse;

class DeploymentController extends Controller
{
    /**
     * List all deployments for the given {project]
     *
     * @param ViewProjectRequest $request
     * @return JsonResponse
     */
    public function actionList(ViewProjectRequest $request): JsonResponse
    {
        return new JsonResponse($request->model()->deployments);
    }

    /**
     * Manually trigger a deployment
     *
     * @param ViewProjectRequest $request
     * @return JsonResponse
     */
    public function actionCreate(ViewProjectRequest $request): JsonResponse
    {
        return new JsonResponse('501 Not Implemented', 501);
    }

    /**
     * View a deployment record in detail
     *
     * @param ViewDeploymentRequest $request
     * @return JsonResponse
     */
    public function actionView(ViewDeploymentRequest $request): JsonResponse
    {
        return new JsonResponse($request->model());
    }

    /**
     * POST: /payload/{project}
     *
     * @param DeployProjectRequest $request
     * @return JsonResponse
     */
    public function actionWebHook(DeployProjectRequest $request): JsonResponse
    {
        $event = $request->header('X-GitHub-Event');

        if ($event === 'ping') {
            return new JsonResponse(['message' => 'pong']);
        } else if ($event === 'push') {

            $request->persist();
            $jobs = $request->dispatch();

            // @todo check X-GitHub-Delivery hasn't already got a job dispatched against it
            // @todo if this push event matches an branch that our $project has an environment configured for then dispatch a new deployment

//            $archive = $request->json('repository.archive_url');
//            $archive = str_replace('{archive_format}', 'archive', $archive);
//            $archive = str_replace('{/ref}', $request->json('after'), $archive);


            return new JsonResponse(['message' => 'ok', 'jobs' => count($jobs), 'job_id' => $jobs]);
        }
        return new JsonResponse(['error' => 'Unknown X-GitHub-Event value [' . $event . ']'], 422);
    }
}
