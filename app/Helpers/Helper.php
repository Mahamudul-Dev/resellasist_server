<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\{Collection, Facades\Storage};
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

if (!function_exists('successCollection')) {
    /**
     * @param array $items
     * @param int|null $status
     * @return Collection
     */
    function successCollection(array $items = [], int $status = null): Collection
    {
        $res = [
            'status' => "success",
            "error" => false,
            'responseStatus' => $status ?? ResponseAlias::HTTP_OK,
        ];

        foreach ($items as $key => $item) {
            $res[$key] = $item;
        }

        return new Collection($res);
    }
}

if (!function_exists('failedCollection')) {
    /**
     * @param array $items
     * @param int|null $status
     * @return Collection
     */
    function failedCollection(array $items = [], int $status = null): Collection
    {
        $res = [
            'status' => "failed",
            "error" => true,
            'responseStatus' => $status ?? ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
        ];

        foreach ($items as $key => $item) {
            $res[$key] = $item;
        }
        return new Collection($res);
    }
}

if (!function_exists('apiResponse')) {
    /**
     * @param $response
     * @return JsonResponse
     */
    function apiResponse($response)
    {
        return response()->json($response->except(['responseStatus']), $response['responseStatus']);
    }
}
if (!function_exists('upload')) {
    /**
     * @param $file
     * @param $path
     * @param $old
     * @return false|string|void
     */
    function upload($file, $path, $old = null)
    {
        $code = date('ymdhis') . '-' . rand(1111, 9999);

        if (!empty($old)) {
            $oldFile = oldFile($old);
            if (Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }
        }
        //FILE UPLOAD
        if (!empty($file)) {
            $fileName = $code . "." . $file->getClientOriginalExtension();
            makeDir($path);
            return Storage::disk('public')->putFileAs('upload/' . $path, $file, $fileName);
        }
    }
}
if (!function_exists('makeDir')) {
    /**
     * @param $folder
     * @return void
     */
    function makeDir($folder): void
    {
        $main_dir = storage_path("app/public/upload/{$folder}");
        if (!file_exists($main_dir)) {
            mkdir($main_dir, 0777, true);
        }
    }
}
if (!function_exists('oldFile')) {
    /**
     * @param $file
     * @return string
     */
    function oldFile($file): string
    {
        $ex = explode('storage/', $file);
        return $ex[1] ?? "";
    }
}

if (!function_exists('deleteFile')) {
    /**
     * @param $file
     * @return void
     */
    function deleteFile($file): void
    {
        if (Storage::disk('public')->exists($file)):
            Storage::delete($file);
        endif;
    }
}
