<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayloadController extends Controller
{
    public function actionPayload(Request $request) {
        return new JsonResponse('Hello world');
    }
}
