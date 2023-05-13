<?php

namespace App\Services\Merchant\Auth;

use App\Models\Merchant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\{Collection, Facades\Auth, Facades\Hash};

class AuthService
{
    /**
     *
     */
    public const GUARD = 'merchant';
    /**
     * @var Collection
     */
    private Collection $collection;

    /**
     * @param Request $request
     * @return Collection
     */
    public function register(Request $request): Collection
    {
        try {
            $data = $this->setRegistrationData($request->validated());
            $user = Merchant::create($data);
            $this->collection = successCollection([
                'message' => __('auth.registration.success', ['resource' => 'Merchant']),
                'merchant' => [
                    'id' => $user->id,
                    'merchant_name' => $user->merchant_name,
                ],
            ]);
        } catch (Exception $ex) {
            $this->collection = failedCollection(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function login(Request $request): Collection
    {
        try {
            $data = $request->validated();
            $this->collection = Auth::guard(self::GUARD)->attempt($data) ? successCollection(
                [
                    'message' => trans('auth.success'),
                    'token' => $this->generateAuthToken($data['email']),
                ]
            ) : failedCollection(['message' => trans('auth.failed')]);
        } catch (Exception $ex) {
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

    /**
     * @param $validated
     * @return array
     */
    private function setRegistrationData($validated): array
    {
        $data = collect($validated)->except(['password', 'owner_pic', 'merchant_logo'])->toArray();
        $data['password'] = Hash::make($validated['password']);
        if (array_key_exists('owner_pic', $validated)) {
            $data['owner_pic'] = upload($validated['owner_pic'], "merchant/pic");
        }
        if (array_key_exists('merchant_logo', $validated)) {
            $data['merchant_logo'] = upload($validated['merchant_logo'], "merchant/logo");
        }

        return $data;
    }

    /**
     * @param string $email
     * @return mixed
     */
    private function generateAuthToken(string $email): mixed
    {
        $user = Merchant::where('email', $email)->first();
        return $user->createToken('token', ['merchant'])->plainTextToken;
    }

}
