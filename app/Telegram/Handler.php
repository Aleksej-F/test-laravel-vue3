<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;
use DefStudio\Telegraph\Models\TelegraphChat;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class Handler extends WebhookHandler
{
    public function hello(string $name): void
    {
        $this->reply("Привет, $name!");
    }

    public function help(): void
    { 
        // $messsss = $this->message->toArray();
        // $chat_test = $messsss['chat']['id'];
        // $chat = $this->chat;
        // if (($chat_test == 1201041131) or ($chat_test == -1002363116448)){

       
            // $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
            // $this->reply(json_encode($messsss['chat']['id'], flags: JSON_UNESCAPED_UNICODE));
            // $chat = TelegraphChat::where('chat_id', intval($messsss['chat']['id']));
            // $chat = TelegraphChat::find(2);
            // $chat = $messsss['chat'];
            
            // $this->reply(json_encode( $chat->memberCount(), flags: JSON_UNESCAPED_UNICODE));
            // $chat = new TelegraphChat($messsss['chat']['id']);
            // $chat = TelegraphChat::find(13);
            // $chat->withData('caption', 'test')->message('hello')->send();
            // $chat->info();
            // $chat->html('<b>Ой, Я только учусь...</b>')->send();
            // $this->reply(json_encode( $chat->memberInfo(), flags: JSON_UNESCAPED_UNICODE));
        // };
        
        // $response = $chat->message('Ой, Я только учусь...')->send();
       
        // $this->reply(json_encode($response, flags: JSON_UNESCAPED_UNICODE));
        

         // ID вашей группы Telegram
        //  $groupId = $messsss['chat']['id']; // Укажите реальный идентификатор вашей группы
        //  $groupId = Telegraph::chatInfo();
        //  $this->reply(json_encode( Telegraph::chatInfo()->send(), flags: JSON_UNESCAPED_UNICODE));
        //  Telegraph::chatInfo()->send();
         //  try {
        //      // Получаем всех участников группы
        //      $response = Telegraph::getChatMemberCount($groupId);
        //      $this->reply(json_encode($response, flags: JSON_UNESCAPED_UNICODE));
        //      if ($response->telegraphOk()) {
        //          $membersCount = $response->getResult(); @Why_buy_lists_bot
                 
        //          // Получение полной информации обо всех участниках
        //          $responseAllMembers = Telegraph::getChatMembers($groupId);
 
        //          if ($responseAllMembers->telegraphOk()) {
        //              $allMembers = $responseAllMembers->getResult();
                     
        //              $this->reply(json_encode([
        //                  'total_members_count' => $membersCount,
        //                  'members_list' => $allMembers
        //              ], flags: JSON_UNESCAPED_UNICODE));
        //          }
        //      }
        //  } catch (\Exception $e) {
        //     $this->reply(json_encode(['error' => $e->getMessage()], flags: JSON_UNESCAPED_UNICODE));
        //  }
         
        //  $this->reply('Failed to fetch group members');
         
    }
    public function open_lists(): void
    {
    //    $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
    //    $chat = TelegraphChat::find(44);
    //    $chatSet =  new TelegraphChat($this->message->chat);
     $this->reply('Я этому еще учусь');
    //    Telegraph::message('Выбери какое-то действие')
    //     ->keyboard(
    //         Keyboard::make()->buttons([
    //             Button::make('Перейти на сайт')->loginUrl('https://tasklist.ecostroi-spb.ru')
    //         ])
    //     )->send();
        
      
        // $this->url('https://tasklist.ecostroi-spb.ru');
        //Button::make('Перейти на сайт')->loginUrl('https://login.url.dev');
       

    }
    public function actions(): void
    {
        $messsss = $this->message->toArray();
        $chat_test = $messsss['chat']['id'];
        $this->reply(json_encode( $chat_test>0, flags: JSON_UNESCAPED_UNICODE));
        $this->chat->message('Выбери какое-то действие')
        ->keyboard(
            Keyboard::make()->buttons([
                Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru'),
                Button::make('Авторизоваться на сайте')->loginUrl('https://tasklist.ecostroi-spb.ru/loginbottg'),
                $chat_test > 0 ? Button::make('Open mini App')->webApp('https://tasklist.ecostroi-spb.ru/miniappautch'): Button::make('')->action(''),
            ])
        )->send();
        // Telegraph::message('Выбери какое-то действие')
        //     ->keyboard(
        //         Keyboard::make()->buttons([
        //             // Button::make('Перейти на сайт')->loginUrl('https://tasklist.ecostroi-spb.ru'),
        //             Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru'),
        //             Button::make('Поставить лайк')->action('like'),
        //             Button::make('Подписаться')
        //                 ->action('subscribe')
        //                 ->param('channel_name', '@areaweb'),
        //         ])
        //     )->send();
    }
    public function shopping_list(): void
    {

        // $keyboard = ReplyKeyboard::make()
        //     ->button('Send Contact')->requestContact()
        //     ->button('Send Location')->requestLocation()
        //     ->inputPlaceholder("Waiting for input...");

        // $this->chat->message('Выбери какое-то действие')
        // ->replyKeyboard($keyboard
            
        // )->send();
    }
    //создание списка
    public function create_shopping_list(): void
    {
        $messsss = $this->message->toArray();
        $chatId = $messsss['chat']['id'];
        
        // Получаем текст сообщения.
        $text = $messsss['text'] ?? null;
        
        if ($text) {
            // Обрабатываем текст сообщения.

            // Пример: Отвечаем эхом на сообщение.
            $response = "Вы написали: " . $text;

            Telegraph::chat($chatId)
                ->message($response)
                ->send();

        }

        // $keyboard = ReplyKeyboard::make()
        //     ->button('Send Contact')->requestContact()
        //     ->button('Send Location')->requestLocation()
        //     ->inputPlaceholder("Введите название для списка...");

        // $this->chat->message('Выбери какое-то действие')
        // ->replyKeyboard($keyboard
            
        // )->send();
    }
    public function like(): void
    {
        Telegraph::message('Спасибо за твой крутой лайк!')->send();
    }

    public function subscribe(): void
    {
        $this->reply("Спасибо за подписку на {$this->data->get('channel_name')}");
    }

    public function start(): void
    {
        $messsss = $this->message->toArray();
        $chat_test = $messsss['chat']['id'];
        // Получаем текст сообщения.
        $textMes = $messsss['text'] ?? null;
        
        if (strpos($textMes, '/start') === 0) {
            // Извлекаем параметр из команды /start
            $parameter = trim(substr($textMes, strlen('/start')));
            // $this->reply($textMes.' - '. $parameter);

            if (empty($parameter)) {
                $this->reply('Рад тебя видеть! Давай начнем пользоваться мной :-)');
                return;
            }
           // Разбираем параметр (предполагаем формат "share_CONTENT_ID")
            $parts = explode("_", $parameter);

            if (count($parts) !== 2 || $parts[0] !== "share") {
                $this->reply("Неверный формат параметра.");
                return;
            }
            $contentId = $parts[1];
            // $this->reply($contentId);
            $this->chat->message("Вас приглашают присоединиться к списку покупок. " .
            "\n\nВыберите один из способов для просмотра. 😊")
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru/tasklist/share/'.$contentId),
                    Button::make('Авторизоваться на сайте')->loginUrl('https://tasklist.ecostroi-spb.ru/loginbottg/tasklist/share/'.$contentId),
                    $chat_test > 0 ? Button::make('Open mini App')->webApp('https://tasklist.ecostroi-spb.ru/tasklist/share/'.$contentId): Button::make('')->action(''),
                ])
            )->send();
        }

    }

    

    protected function handleUnknownCommand(Stringable $text): void
    {
       
           
        $this->reply('Неизвестная команда');
          
       
    }

    protected function handleChatMessage(Stringable $text): void
    {
        Log::info(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
        // $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
        $messsss = $this->message->toArray();
        $chat_test = $messsss['chat']['id'];
        // $this->reply($text);
       
    }
}