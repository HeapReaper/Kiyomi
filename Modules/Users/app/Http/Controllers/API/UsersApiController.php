<?php

namespace Modules\Users\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersApiController extends Controller 
{
    public function createUser(Request $request): JsonResponse
    {
        dd($request->name);
        return response()->json(['success' => 'hi, atiq']);
    }
}