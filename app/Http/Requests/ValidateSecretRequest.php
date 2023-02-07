<?php

namespace App\Http\Requests;

use App\Services\TwoFactorService;
use App\User;
use Cache;
use Google2FA;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidatonFactory;

class ValidateSecretRequest extends FormRequest
{
    /**
     * @var \App\User
     */
    private $user;

    protected $twoFactorService;

    /**
     * Create a new FormRequest instance.
     *
     * @param  \Illuminate\Validation\Factory  $factory
     * @return void
     */
    public function __construct(ValidatonFactory $factory, TwoFactorService $twoFactorService)
    {
        $this->twoFactorService = $twoFactorService;
        $factory->extend(
            'valid_token',
            function ($attribute, $value, $parameters, $validator) {
                $secret = $this->user->google2fa_secret;
                // just for first time enable service
                if (! $this->user->hasTwoFactore() && request()->has('first-time-secret')) {
                    $secret = request()->get('first-time-secret');
                }

                return Google2FA::verifyKey($secret, $value);
            },
            trans('otp.error_code')
        );

        $factory->extend(
            'used_token',
            function ($attribute, $value, $parameters, $validator) {
                $key = $this->user->id.':'.$value;

                return ! Cache::has($key);
            },
            trans('otp.can_not_reuse_token')
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $this->user = $this->twoFactorService->findUserBySession();
        } catch (Exception $exc) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'totp' => 'required|digits:6|valid_token|used_token',
        ];
    }
}
