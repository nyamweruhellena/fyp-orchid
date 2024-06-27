<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomRole;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * POST api/login
     *
     * Logs-in user(s) to the specified dashboard
     *
     * @unauthenticated
     *
     * @bodyParam phone string required phone of the user, should be valid email, unique to the users table
     * @bodyParam password string required Must be at least 6 characters
     *
     */
    public function login(Request $request)
    {
        // Validate the input email and password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Return error message if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => Config::get('customMessages.VALIDATION_ERROR'),
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user exists
        $user = User::where('email', $request->email)->first();

        // var_dump($user); die();

        // If user does not exist return error message
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => Config::get('customMessages.USER_NOT_FOUND')
            ], 404);
        } else {
            // Check if password matches
            if (password_verify($request->password, $user->password)) {
                // Create user token
                $token = $user->createToken('authToken')->accessToken;

                // Return success message with token
                return response()->json([
                    'success' => true,
                    'message' => Config::get('customMessages.LOGIN_SUCCESS'),
                    'data' => [
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'role' => $user->customRole?$user->customRole->name:"",
                        ],
                        'token' => $token
                    ]
                ], 200);
            } else {
                // Return error message if password does not match
                return response()->json([
                    'success' => false,
                    'message' => Config::get('customMessages.WRONG_CREDENTIALS')
                ], 401);
            }
        }
    }

    public function register(Request $request)
    {
        // Validate the input email and password
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        // Return error message if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => Config::get('customMessages.VALIDATION_ERROR'),
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user exists
        $user = new User();
        $user->name = $request->name;
        $user->emai = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $role_id = CustomRole::where('name',$request->name)->first()->id;

        $roleUser= new RoleUser();
        $roleUser->user_id = $user->id;
        $roleUser->role_id = $role_id;
        $roleUser->save();
        // var_dump($user); die();

        // If user does not exist return error message
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => Config::get('customMessages.USER_NOT_FOUND')
            ], 404);
        } else {
            // Check if password matches
          
                // Create user token
                $token = $user->createToken('authToken')->accessToken;

                // Return success message with token
                return response()->json([
                    'success' => true,
                    'message' => Config::get('customMessages.LOGIN_SUCCESS'),
                    'data' => [
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'role' => $user->customRole->name,
                        ],
                        'token' => $token
                    ]
                ], 200);
        }
    }

    /**
     * POST api/logout
     *
     * Logs-out user(s) from the specified dashboard
     *
     * @authenticated
     *
     * @response {
     *  "message": "Successfully logged out"
     * }
     */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response(['message' => 'Successfully logged out'], 200);
    }
}
