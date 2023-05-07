<?php

namespace App\Services\Reseller\Auth;

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
            $user = Reseller::create($data);
            DB::commit();
            $this->collection = successCollection([
                'message' => __('auth.registration.success', ['resource' => 'Reseller']),
                'reseller' => [
                    'id' => $user->id,
                    'reseller_name' => $user->reseller_name,
                ],
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    /*
  |--------------------------------------------------------------------------
  | class internal methods
  |--------------------------------------------------------------------------
  |
  */
    private function setRegistrationData($validated): array
    {
        $data = collect($validated)->except(['password', 'profile_pic'])->toArray();
        $data['password'] = Hash::make($validated['password']);
        $data['profile_pic'] = upload($validated['profile_pic'], "reseller/pic");
        return $data;
    }

}
