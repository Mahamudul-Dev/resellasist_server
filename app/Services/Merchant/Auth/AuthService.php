<?php

namespace App\Services\Merchant\Auth;

use App\Models\Merchant;
use App\Models\Reseller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\{Collection, Facades\DB, Facades\Hash};


class AuthService
{
    private Collection $collection;

    public function register(Request $request): Collection
    {
        try {
            DB::beginTransaction();
            $data = $this->setRegistrationData($request->validated());
            $user = Merchant::create($data);
            DB::commit();
            $this->collection = successCollection([
                'message' => __('auth.registration.success', ['resource' => 'Merchant']),
                'merchant' => [
                    'id' => $user->id,
                    'merchant_name' => $user->merchant_name,
                ],
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    private function setRegistrationData($validated): array
    {
        $data = collect($validated)->except(['password', 'owner_pic', 'merchant_logo'])->toArray();
        $data['password'] = Hash::make($validated['password']);
        $data['owner_pic'] = upload($validated['owner_pic'], "merchant/pic");
        $data['merchant_logo'] = upload($validated['merchant_logo'], "merchant/logo");
        return $data;
    }

}