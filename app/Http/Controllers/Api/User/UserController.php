<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profileInfo()
    {
        $user = auth()->user();
        return JsonResponse::json('ok', ['data' => UserResource::make($user)]);
    }


}
