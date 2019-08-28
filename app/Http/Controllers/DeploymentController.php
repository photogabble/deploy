<?php

namespace App\Http\Controllers;

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
}
