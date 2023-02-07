<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;

class Google2FAController extends Controller
{
    protected $twoFactorService;

    public function __construct(TwoFactorService $twoFactorService)
    {
        $this->twoFactorService = $twoFactorService;
    }

    public function enableTwoFactor($id, Request $request)
    {
        $data = $this->twoFactorService->enableFirstTime($id);

        return view('google2fa.register', ['data' => $data]);
    }

    public function disableTwoFactor(Request $request)
    {
        return view('google2fa.index', ['disable' => true]);
    }
}
