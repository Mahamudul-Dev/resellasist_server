<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\{LoginRequest,RegistrationRequest};
use App\Services\Merchant\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param AuthService $service
     */
    public function __construct(public AuthService $service)
    {
    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        return apiResponse($this->service->register($request));
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return apiResponse($this->service->login($request));
    }
}
