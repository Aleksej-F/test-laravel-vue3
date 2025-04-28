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

class Handler extends WebhookHandler
{
    public function hello(string $name): void
    {
        $this->reply("Привет, $name!");
    }

    public function help(): void
    { 
        $messsss = $this->message->toArray();
        $chat_test = $messsss['chat']['id'];
        $chat = $this->chat;
        if (($chat_test == 1201041131) or ($chat_test == -1002363116448)){

       
            $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
            $this->reply(json_encode($messsss['chat']['id'], flags: JSON_UNESCAPED_UNICODE));
            // $chat = TelegraphChat::where('chat_id', intval($messsss['chat']['id']));
            // $chat = TelegraphChat::find(2);
            // $chat = $messsss['chat'];
            
            $this->reply(json_encode( $chat, flags: JSON_UNESCAPED_UNICODE));
            // $chat = new TelegraphChat($messsss['chat']['id']);
            // $chat = TelegraphChat::find(13);
            $chat->withData('caption', 'test')->message('hello')->send();
            $chat->info();
            $chat->html('<b>Ой, Я только учусь...</b>')->send();
        };
        
        $response = $chat->message('Ой, Я только учусь...')->send();
        $response -> dump();
        // $response -> dd ();
        $chat->message('Выбери какое-то действие')
        ->keyboard(
            Keyboard::make()->buttons([
                Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru'),
                Button::make('Авторизоваться на сайте')->loginUrl('https://tasklist.ecostroi-spb.ru/loginbottg'),
                $chat_test > 0 ? Button::make('open')->webApp('https://tasklist.ecostroi-spb.ru'): Button::make('open')->action('like'),
            ])
        )->send();
    }
    public function open_lists(): void
    {
       $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
    //    $chat = TelegraphChat::find(44);
    //    $chatSet =  new TelegraphChat($this->message->chat);
    //  $this->reply(json_encode($this->message->chat->toArray(), flags: JSON_UNESCAPED_UNICODE));
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
        $this->chat->message('Выбери какое-то действие')
        ->keyboard(
            Keyboard::make()->buttons([
                Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru'),
                Button::make('Авторизоваться на сайте')->loginUrl('https://tasklist.ecostroi-spb.ru/loginbottg'),
                $chat_test > 0 ? Button::make('open')->webApp('https://tasklist.ecostroi-spb.ru'): Button::make('open')->action('like'),
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
    public function like(): void
    {
        Telegraph::message('Спасибо за твой крутой лайк!')->send();
    }

    public function subscribe(): void
    {
        $this->reply("Спасибо за подписку на {$this->data->get('channel_name')}");
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($text->value() === '/start') {
            $this->reply('Рад тебя видеть! Давай начнем пользоваться мной :-)');
        } else {
            $this->reply('Неизвестная команда');
        }
    }

    protected function handleChatMessage(Stringable $text): void
    {
        Log::info(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
        // $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
        // $this->reply($text);
    }
}