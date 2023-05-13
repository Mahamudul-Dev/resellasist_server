<?php

namespace App\Services\Merchant\Auth;

use App\Http\Resources\MerchantResource;
use App\Models\Merchant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\{Collection, Facades\Hash};

class ProfileService
{
    private string $resource = "Merchant";

    private Collection $collection;

    public function getProfile($id): Collection
    {
        if ($profile = Merchant::find($id)) {
            return successCollection([
                'merchant' => new MerchantResource($profile)
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
            if ($profile = Merchant::find($id)) {
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
        } catch (Exception $ex) {
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    private function prepareProfileData($validated)
    {
        $data = array_filter($validated, function ($value) {
            return $value !== null;
        });

        if (array_key_exists('owner_pic', $data)) {
            $data['owner_pic'] = upload($data['owner_pic'], "merchant/pic");
        }
        if (array_key_exists('merchant_logo', $data)) {
            $data['merchant_logo'] = upload($data['merchant_logo'], "merchant/logo");
        }

        if (array_key_exists('password', $data)) {
            $data['password'] = Hash::make($data['password']);
        }


        return $data;
    }

    public function deleteProfile($id): Collection
    {
        try {
            if ($profile = Merchant::find($id)) {
                $profile->delete();
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