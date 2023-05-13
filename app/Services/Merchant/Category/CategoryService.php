<?php

namespace App\Services\Merchant\Category;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryService
{
    private Collection $collection;
    /**
     * @var string
     */
    private string $resource = "Category";

    /**
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $categories = Category::get();
        return successCollection([
            'category' => CategoryResource::collection($categories)
        ]);
    }


    /**
     * @param Request $request
     * @return Collection
     */
    public function store(Request $request): Collection
    {
        try {
            $data = $request->validated();
            Category::create($data);
            $this->collection = successCollection([
                'message' => trans('resource.create', ['resource' => $this->resource])
            ]);
        } catch (Exception $ex) {
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function show($id): Collection
    {
        if ($category = Category::find($id)) {
            return successCollection([
                'category' => new CategoryResource($category)
            ]);
        } else {
            return failedCollection([
                'error' => trans('resource.notFound', ['resource' => $this->resource])
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Collection
     */
    public function update(Request $request, $id): Collection
    {
        try {
            if ($category = Category::find($id)) {
                $category->update($request->validated());
                $this->collection = successCollection([
                    'message' => trans('resource.update', ['resource' => $this->resource])
                ]);
            } else {
                $this->collection = failedCollection([
                    'error' => trans('resource.notFound', ['resource' => $this->resource])
                ]);
            }
        } catch (Exception $ex) {
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function destroy($id): Collection
    {
        try {
            if ($category = Category::find($id)) {
                $category->delete();
                $this->collection = successCollection([
                    'message' => trans('resource.destroy', ['resource' => $this->resource])
                ]);
            } else {
                $this->collection = failedCollection([
                    'error' => trans('resource.notFound', ['resource' => $this->resource])
                ]);
            }
        } catch (Exception $ex) {
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

}