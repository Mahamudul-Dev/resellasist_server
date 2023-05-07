<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\RegistrationRequest;
use App\Services\Merchant\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {
    }

    public function register(RegistrationRequest $request): JsonResponse
    {
        return apiResponse($this->service->register($request));
    }
}
