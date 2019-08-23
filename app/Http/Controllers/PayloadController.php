<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayloadController extends Controller
{
    public function actionPayload(Request $request, $project) {
        $event = $request->header('X-GitHub-Event');

        if ($event === 'ping') {
            return new JsonResponse(['message' => 'pong']);
        }

        return new JsonResponse(['error' => 'Unknown X-GitHub-Event value ['.$event.']'], 422);
    }
}
