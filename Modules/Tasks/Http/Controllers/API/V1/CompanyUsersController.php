<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Entities\User;
use Modules\Tasks\Http\Controllers\Controller;
use function request;
use function response;

/**
 * Class CompanyUsersController.
 */
class CompanyUsersController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
            $users = User::
            // where('company_id',auth()->user()->company_id)
            // ->orWhere('branch_id',auth()->user()->branch_id)
            all();

            if (request()->expectsJson()) {
                return response()->json([
                    'data' => $users,
                ]);

        }
    }
}
