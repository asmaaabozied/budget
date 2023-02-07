<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\TwoFactorService;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
//    use   RegistersUsers {
//        // We are doing this so the predefined register method does not clash with this one we just defined.
//        register as registration;
//    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $twoFactorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TwoFactorService $twoFactorService)
    {
        $this->middleware('guest')->except('logout');
        $this->twoFactorService = $twoFactorService;
    }

    protected function authenticated(Request $request, User $user)
    {
        if ($user->status == 0) {
            Auth::logout();
            $redirect = '/login';

            return back()->withErrors(__('انت غير نشط في المنشأة يرجى التواصل مع قسم الموارد البشرية في منشأتك'));
        } elseif ($user->status == 1) {
            if ($user->hasTwoFactore()) {
                Auth::logout();
                $this->twoFactorService->storeSession($user->id);

                return redirect('2fa/validate');
            }

            return redirect()->intended($this->redirectTo);
        } else {
            Auth::logout();
            $redirect = '/login';

            return back()->withErrors(__('site.messages.auth_faild'));
        }
    }
}
