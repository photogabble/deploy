<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayloadController extends Controller
{
    public function actionPayload(Request $request, string $project) {
        $event = $request->header('X-GitHub-Event');

        if ($event === 'ping') {
            return new JsonResponse(['message' => 'pong']);
        } else if ($event === 'push') {
            $archive = $request->json('repository.archive_url');
            $archive = str_replace('{archive_format}', 'archive', $archive);
            $archive = str_replace('{/ref}',  $request->json('after'), $archive);
            return new JsonResponse(['message' => 'ok', 'download' => $archive]);
        }
        return new JsonResponse(['error' => 'Unknown X-GitHub-Event value ['.$event.']'], 422);
    }
}

// https://github.com/photogabble/deploy/archive/6544c6d4926e7ecc5583df98f71331a06e3cabf1.zip
