<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Requests\User\LoginUserValidator;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Requests\User\CreateUserValidator;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Auth;


class RegisterController extends BaseController
{

    public  $userService;

    public function __construct(UserService $userService)
    {
        $this -> userService = $userService;
    }

    public function register(CreateUserValidator $createUserValidator )
    {

        if (!empty($createUserValidator->getErrors()))
        {
            return response()->json($createUserValidator->getErrors(),406);
        }
        $user = $this ->userService -> createUser($createUserValidator->request()->all());
        $message ['user'] = $user;
        $message ['token'] = $user -> createToken('MyApp')->plainTextToken;
        return $this->sendResponse($message);
    }
    public function login (LoginUserValidator $loginUserValidator)
    {
        if (!empty($loginUserValidator->getErrors()))
        {
            return response()->json($loginUserValidator->getErrors(),406);
        }
        $request = $loginUserValidator->request();
        if (Auth::attempt (['email' => $request -> email ,'password' => $request -> password ]))
        {
            $user = Auth::user();
            $success ['token'] = $user -> createToken('MyApp')->plainTextToken;
            $success ['name'] = $user -> name;

            return $this -> sendResponse($success,'User login successfully');
        }
        else
        {
            return $this ->sendResponse( 'unauth','fail',401);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
    public function sendVerification(Request $request)
    {
        $user = $request->user();
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email sent'], 200);
    }
}
