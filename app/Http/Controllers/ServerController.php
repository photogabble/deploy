<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ViewRequest as ViewProjectRequest;
use App\Http\Requests\Server\ViewRequest as ViewServerRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServerController extends Controller
{
    public function actionList (ViewProjectRequest $request) : JsonResponse {
        return new JsonResponse($request->model()->servers());
    }

    public function actionCreate (Request $request) : JsonResponse {
        return new JsonResponse('501 Not Implemented', 501);
    }

    public function actionView (ViewServerRequest $request): JsonResponse {
        return new JsonResponse($request->model());
    }

    public function actionUpdate (ViewServerRequest $request) : JsonResponse
    {
        return new JsonResponse('501 Not Implemented', 501);
    }

    /**
     * @param ViewServerRequest $request
     * @return Response
     * @throws Exception
     */
    public function actionDelete (ViewServerRequest $request): Response {
        if ($request->model()->delete() === true) {
            return response('', 204);
        }

        // If there is an error then an exception will be thrown by the model
        // delete and this will never be hit.
    }
}
