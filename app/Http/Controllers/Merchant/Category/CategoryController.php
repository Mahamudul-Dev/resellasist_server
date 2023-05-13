<?php

namespace App\Http\Controllers\Merchant\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\CategoryRequest;
use App\Services\Merchant\Category\CategoryService;
use Illuminate\Http\{JsonResponse, Request};

class CategoryController extends Controller
{

    public function __construct(public CategoryService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return apiResponse($this->service->index($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        return apiResponse($this->service->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return apiResponse($this->service->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id): JsonResponse
    {
        return apiResponse($this->service->update($id, $request));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return apiResponse($this->service->destroy($id));
    }
}
