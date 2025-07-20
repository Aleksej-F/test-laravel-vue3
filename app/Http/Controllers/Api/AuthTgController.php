<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\PasswordRequest;
use App\Contracts\ResponseContract;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTg;
use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Models\TelegraphBot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthTgController extends Controller
{
    // define('BOT_TOKEN', 'XXXXXXXX:XXXXXXXXXXXXXXXXXXXXXXXX'); // place bot token of your bot here
    /**
     * Ключ бота, полученный от BotFather.
     * **Важно:** Храните его в .env файле и не коммитьте в репозиторий!
     */
    private string $botToken;
    
    public function __construct(public ResponseContract $json)
    {
        $bot = TelegraphBot::find(1);
        $this->botToken = $bot['token'];
        // $this->botToken = env('TELEGRAM_BOT_TOKEN', '');  // Получаем из .env, если не установлен - пустая строка
        if (empty($this->botToken)) {
            Log::error('TELEGRAM_BOT_TOKEN is not set in .env file.');
            // Можно выбросить исключение или предпринять другие действия
        }
    }
     /**
     * Обрабатывает запрос от Telegram Mini App.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //  /miniappautch
    public function authenticate(Request $request)
    {
        Log::info('Mini App Request:', $request->all());

        $initData = $request->input('initData'); // Получаем строку initData
        $user = null;

        if (empty($initData)) {
            Log::warning('initData is empty.');
            // return response()->json(['error' => 'initData is required'], 400);
            return $this->json->error(
                message: 'initData is required',
                errors: 403
            );
        }

        try {
            // 1. Валидация initData
            $valid = $this->validateInitData($initData, $this->botToken);

            if (!$valid) {
                Log::warning('Invalid initData.');
                // return response()->json(['error' => 'Invalid initData'], 401);
                return $this->json->error(
                    message: 'Invalid initData',
                    errors: 401
                );
            }

            // 2. Извлечение информации о пользователе (если есть)
            $userData = $this->extractUserData($initData);

            if ($userData) {
                // 3. Авторизация пользователя (или создание, если его нет)
                $user = $this->authenticateOrCreateUser($userData);

                // 4. Создание токена (например, с использованием Sanctum)
                $token = $user->createToken('api_token')->plainTextToken;

                Log::info('User authenticated/created successfully. User ID: ' . $user->id);

                return $this->json->response([
                    'token' => $token,
                    'user' => $user, // Можно вернуть данные пользователя
                ],
                message: 'Успешная авторизация.',
            );
            } else {
                Log::info('No user data found in initData (e.g., user opened the mini app without authorization).');
                // Если нет данных о пользователе, это может быть неавторизованный доступ
                return response()->json(['message' => 'No user data found.'], 200); // Можно вернуть сообщение или redirect
            }

        } catch (\Exception $e) {
            Log::error('Mini App Authentication Error: ' . $e->getMessage());
            return response()->json(['error' => 'Authentication failed'], 500);
        }
    }

    /**
     * Валидирует initData, полученный от Telegram.
     *
     * @param  string  $initData
     * @param  string  $botToken
     * @return bool
     */
    private function validateInitData(string $initData, string $botToken): bool
    {
        // 1. Разбиваем строку initData на параметры
        $params = [];
        parse_str(str_replace('?', '', $initData), $params); // Удаляем "?" если есть
        Log::info($params);
        Log::info('$botToken = '. $botToken);
        // 2. Проверяем наличие параметра "hash"
        if (!isset($params['hash'])) {
            Log::warning('Missing "hash" parameter in initData.');
            return false;
        }

        $hash = $params['hash'];
        unset($params['hash']); // Удаляем "hash" из массива параметров

        // 3. Сортируем параметры по ключу (в алфавитном порядке)
        sort($params);

        // 4. Формируем строку данных для проверки (data-check-string)
        $dataCheckString = [];
        foreach ($params as $key => $value) {
            $dataCheckString[] = $key . '=' . $value;
        }
        $dataCheckString = implode("\n", $dataCheckString);

        // 5. Вычисляем HMAC-SHA-256
        $secretKey = hash('sha256', $botToken, true);
        $hmac = hash_hmac('sha256', $dataCheckString, $secretKey);

        // 6. Сравниваем вычисленный HMAC с полученным "hash"
        // $isValid = hash_equals($hmac, $hash);
        $isValid = strcmp($hmac, $hash);
        if (!$isValid) {
            Log::warning('HMAC hash mismatch.  Possible tampering.');
        }

        return $isValid;
    }

    /**
     * Извлекает данные пользователя из initData.
     * Возвращает null, если данные о пользователе отсутствуют.
     *
     * @param  string  $initData
     * @return array|null
     */
    private function extractUserData(string $initData): ?array
    {
        $params = [];
        parse_str(str_replace('?', '', $initData), $params);

        if (isset($params['user'])) {
            try {
                // Декодируем JSON строку с данными пользователя
                $user = json_decode($params['user'], true);
                return $user;
            } catch (\Exception $e) {
                Log::error('Error decoding user data: ' . $e->getMessage());
                return null; // Ошибка декодирования JSON
            }
        }

        return null; // Нет данных о пользователе
    }

    /**
     * Аутентифицирует или создает пользователя на основе данных из Telegram.
     *
     * @param  array  $userData
     * @return \App\Models\User
     */
    private function authenticateOrCreateUser(array $userData): \App\Models\User
    {
        // 1. Ищем пользователя по telegram_id (или другому уникальному идентификатору)
        // $user = User::where('telegram_id', $userData['id'])->first();
        $user =  UserTg::find($userData['id']);
        if (is_null($user) ){
            $user_autch = User::create( ['name' => $userData['first_name']]);
            $userData['user_id'] = $user_autch['id'];
            $user_autch_tg = UserTg::create( $userData);
        } else {
            $user_autch = $user->user;
        }

        return  $user_autch;
    }
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $bot = TelegraphBot::find(1);
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
