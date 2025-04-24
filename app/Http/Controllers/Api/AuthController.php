<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\PasswordRequest;
use App\Contracts\ResponseContract;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController 
{
    public function __construct(public ResponseContract $json)
    {
    }
    public function register(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->validated());

        return $this->json->response([
            'token' => $user->createToken('api_token')->plainTextToken,
            'message' => 'Успешная регистрация'
        ]);
    }
    public function login(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::firstWhere('email', $request->input('email'));
        if ($user && \Hash::check($request->input('password'), $user->password)) {
            return $this->json->response([
                'token' => $user->createToken('api_token')->plainTextToken,
            ]);

        }
        return $this->json->response([], 'Credentials not match', JsonResponse::HTTP_UNAUTHORIZED);

        
    }
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->json->response([], 'Logged out');
    }
    /*
    * @return \Illuminate\Http\JsonResponse
    */
   public function password(PasswordRequest $request): \Illuminate\Http\JsonResponse
   {
        // $user = User::firstWhere('email', $request->input('password'));
        $user = Auth::user();
        if ($user && \Hash::check($request->input('old_password'), $user->password)) {
            $user->password = $request->input('password');
            $user->save();
            return $this->json->response([], 'пароль был успешно изменен');

        } else {
            return $this->json->error( 'пароль указан неверный', 401, ['old_password' => 'пароль указан неверный']);
            // return $this->json->response(array(
            //     'code'      =>  401,
            //     'message'   =>  'invalid password'
            // ), 401);
        }
   }
   //logoutbottg
   public function logoutbottg(Request $request): \Illuminate\Http\JsonResponse
    {
        $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
        // $user = User::create($request->validated());
        $user =  $request->input();
        return $this->json->response(
            [
                '$bot' =>  $bot,
                'user' => $user, 
                'token'=> 'fdgdgdgdfgdfgdgdg'
            ],
            message: 'Успешная авторизация.',
           
            // 'token' => $user->createToken('api_token')->plainTextToken,
           
        );
    }
}
