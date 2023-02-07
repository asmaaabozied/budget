<?php

namespace App\Services;

use App\User;
use Google2FA;
use ParagonIE\ConstantTime\Base32;

class TwoFactorService
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enable($userId, $secret = null)
    {
        $code = $secret ? $secret : $this->generateSecret();
        $user = $this->findUserById($userId);
        $user->google2fa_secret = $code;
        $user->save();
    }

    public function enableFirstTime($userId)
    {
        $data = [];
        $data['secret'] = $this->generateSecret();
        $user = $this->findUserById($userId);
        $this->storeSession($user->id);
        $data['qr_image'] = $this->getInlineUrl($user->email, $data['secret']);

        return  $data;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disable($userId)
    {
        $user = $this->findUserById($userId);
        $user->google2fa_secret = null;
        $user->save();
        $user->refresh();

        return $user;
    }

    private function getSecretKey()
    {
        if (! $key = $this->getStoredKey()) {
            $key = Google2FA::generateSecretKey($this->keySize, $this->keyPrefix);

            $this->storeKey($key);
        }

        return $key;
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }

    /**
     * @param $key
     * @return mixed
     */
    private function getGoogleUrl($email, $key)
    {
        return Google2FA::getQRCodeGoogleUrl(
            request()->getHttpHost(),
            $email,
            $key
        );
    }

    /**
     * @param $key
     * @return mixed
     */
    private function getInlineUrl($email, $key)
    {
        return Google2FA::getQRCodeInline(
            request()->getHttpHost(),
            $email,
            $key,
            200
        );
    }

    /**
     * find user by ID
     */
    public function findUserById($userId = null)
    {
        $user = User::where('id', $userId)->first();
        if ($user instanceof User) {
            return $user;
        }

        return null;
    }

    /**
     * find user by google2Fa Session key
     */
    public function findUserBySession()
    {
        return $this->findUserById($this->getSession());
    }

    /**
     * store session val to return from everywhere
     */
    public function storeSession($sessionVal = null): void
    {
        request()->session()->put(config('google2fa.session_var'), $sessionVal);
    }

    /**
     * get session value
     */
    public function getSession()
    {
        if (request()->session(config('google2fa.session_var'))) {
            return request()->session()->get(config('google2fa.session_var'));
        }
    }

    /**
     * destroy user session related to twooFactor service
     */
    public function destroyUserSession()
    {
        if (auth()->user()->google2fa_secret) {
            if (request()->session(config('google2fa.session_var'))) {
                request()->session()->forget(config('google2fa.session_var'));
            }
        }
    }
}
