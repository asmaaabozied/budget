<?php

namespace Modules\Tasks\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Entities\User;
use Modules\Tasks\Http\Resources\UserResource;

/**
 * @group Authentication
 *
 * API endpoints for managing authentication
 **/
class AuthController extends Controller
{
    /**
     * Register in the system.
     *
     * @bodyParam   name    string  required    The name of the  user.      Example: Omar Ahmed
     *  @bodyParam   email    string  required    The email of the  user.      Example: testuser@example.com
     * @bodyParam   phone    string  required    The phone of the  user.      Example: 00966533222222
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     * @bodyParam   c_password    string  required    The confirmed password of the  user
     *
     * @response {
     *  "access_token": "eyJ0eXA... etc",
     *  "token_type": "Bearer",
     * }
     **/
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'c_password' => ['required|same:password'],
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);

        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message' => 'Successfully created user!',
                'accessToken' => $token,
            ], 201);
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @response {
     *  "access_token": "eyJ0eXA...",
     *  "token_type": "Bearer",
     * }
     **/
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);
        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'OOOPS You are Unauthorized',
            ], 401);
        }

        $user = $request->user();
        $userData = new UserResource($user);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'userData' => $userData,
        ]);

        //	return response()->json(new JsonResponse(new UserResource($user)));
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
