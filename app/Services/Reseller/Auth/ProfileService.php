<?php

namespace App\Services\Reseller\Auth;

use App\Http\Resources\ResellerResource;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    private string $resource = "Reseller";

    private Collection $collection;

    public function getProfile($id): Collection
    {
        if ($profile = Reseller::find($id)) {
            return successCollection([
                'reseller' => new ResellerResource($profile)
            ]);
        } else {
            return failedCollection([
                'error' => trans('resource.notFound', ['resource' => $this->resource])
            ]);
        }
    }

    public function updateProfile($id, Request $request): Collection
    {
        try {
            DB::beginTransaction();
            if ($profile = Reseller::find($id)) {
                $data = $this->prepareProfileData($request->validated());
                $profile->update($data);
                $this->collection = successCollection([
                    'message' => trans('resource.update', ['resource' => $this->resource])
                ]);
            } else {
                $this->collection = failedCollection([
                    'error' => trans('resource.notFound', ['resource' => $this->resource])
                ]);
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    private function prepareProfileData($validated)
    {
        $data = array_filter($validated, function ($value) {
            return $value !== null;
        });

        if (array_key_exists('profile_pic', $validated)) {
            $data['profile_pic'] = upload($validated['profile_pic'], "reseller/pic");
        }

        if (array_key_exists('password', $validated)) {
            $data['password'] = Hash::make($validated['password']);
        }

        return $data;
    }
}