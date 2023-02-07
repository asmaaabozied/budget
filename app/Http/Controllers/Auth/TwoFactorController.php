<?php

namespace App\Http\Controllers\Auth;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateSecretRequest;
use App\Providers\RouteServiceProvider;
use App\Services\TwoFactorService;
use Cache;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $twoFactorService;

    public function __construct(TwoFactorService $twoFactorService)
    {
        $this->middleware('web');
        $this->twoFactorService = $twoFactorService;
    }

    public function getValidateToken()
    {
        if ($this->twoFactorService->getSession()) {
            return view('google2fa.index');
        }

        return redirect('login');
    }

    /**
     * @param  App\Http\Requests\ValidateSecretRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postValidateToken(ValidateSecretRequest $request)
    {
        $user = $this->twoFactorService->findUserBySession();
        $key = $user->id.':'.request()->totp;

        // first time enable service
        if (! $user->hasTwoFactore() && request()->has('first-time-secret')) {
            $this->twoFactorService->enable($user->id, request()->get('first-time-secret'));
            alert()->success(trans('otp.done'), trans('otp.enable_service'));
        }

        // if need to disable service
        if ($user->hasTwoFactore() && request()->get('disable-two-factor') == true) {
            $data = $this->twoFactorService->disable($user->id);
            Alert::warning(trans('otp.done'), trans('otp.disable_service'));
        }

        Cache::add($key, true, 4);
        Auth::loginUsingId($user->id);

        return redirect()->intended($this->redirectTo);
    }
}
