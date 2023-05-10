<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\ProfileRequest;
use App\Services\Merchant\Auth\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function __construct(public ProfileService $service)
    {
    }

    public function getProfile($id): JsonResponse
    {
        return apiResponse($this->service->getProfile($id));
    }

    public function updateProfile(ProfileRequest $request, $id): JsonResponse
    {
        return apiResponse($this->service->updateProfile($id, $request));
    }

    public function deleteProfile($id): JsonResponse
    {
        return apiResponse($this->service->deleteProfile($id));
    }
}
