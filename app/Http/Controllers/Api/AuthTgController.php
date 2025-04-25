<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\PasswordRequest;
use App\Contracts\ResponseContract;
use Illuminate\Http\Request;
use App\Models\User;
use DefStudio\Telegraph\Models\TelegraphChat;
use App\Http\Controllers\Controller;

class AuthTgController extends Controller
{
    // define('BOT_TOKEN', 'XXXXXXXX:XXXXXXXXXXXXXXXXXXXXXXXX'); // place bot token of your bot here
    
    
    public function __construct(public ResponseContract $json)
    {
    }
    
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
        $chat = TelegraphChat::find(1);
        $chat->message('hello')->send();

        define('BOT_TOKEN', $bot['token']); // place bot token of your bot here
        
        $check_hash = $request->input('hash');
        unset($request['hash']);
        $data_check_arr = [];
        foreach ($request as $key => $value) {
            $data_check_arr[] = $key . '=' . $value;
          }
          sort($data_check_arr);
          $data_check_string = implode("\n", $data_check_arr);
          $chat->message( $data_check_string)->send();

        //    $secret_key = hash('sha256', BOT_TOKEN, true);
        //   $hash = hash_hmac('sha256', $data_check_string, $secret_key);
        
        
          return
        
        
        
        $user = User::firstWhere('email', $request->input('email'));
        
        
        
        if ($user && \Hash::check($request->input('password'), $user->password)) {
            return $this->json->response([
                'token' => $user->createToken('api_token')->plainTextToken,
            ]);

        }

        return $this->json->response(
            [], 'Credentials not match', JsonResponse::HTTP_UNAUTHORIZED);

        
    }
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->json->response([], 'Logged out');
    }

    public function setMesseng(): \Illuminate\Http\JsonResponse
    {
        $chat = TelegraphChat::find(1);
        $chat->message('hello')->send();
        return $this->json->response([], 'Logged out');
    }
   
 
}
