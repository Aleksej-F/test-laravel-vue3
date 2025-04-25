<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
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
        $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
        $this->reply(json_encode($messsss['chat']['id'], flags: JSON_UNESCAPED_UNICODE));
        // $chat = TelegraphChat::where('chat_id', intval($messsss['chat']['id']));

        $chat = $this->chat;
        $this->reply(json_encode( $chat, flags: JSON_UNESCAPED_UNICODE));
        // $chat = new TelegraphChat($messsss['chat']['id']);
        // $chat = TelegraphChat::find(13);
        //  $chat->message('hello')->send();
        $chat->message('Выбери какое-то действие')
        ->keyboard(
            Keyboard::make()->buttons([
                Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru'),
                Button::make('Перейти на сайт')->loginUrl('https://tasklist.ecostroi-spb.ru/loginbottg'),
                Button::make('open')->webApp('https://tasklist.ecostroi-spb.ru'),
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


        Telegraph::message('Выбери какое-то действие')
            ->keyboard(
                Keyboard::make()->buttons([
                    // Button::make('Перейти на сайт')->loginUrl('https://tasklist.ecostroi-spb.ru'),
                    Button::make('Перейти на сайт')->url('https://tasklist.ecostroi-spb.ru'),
                    Button::make('Поставить лайк')->action('like'),
                    Button::make('Подписаться')
                        ->action('subscribe')
                        ->param('channel_name', '@areaweb'),
                ])
            )->send();
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
        $this->reply(json_encode($this->message->toArray(), flags: JSON_UNESCAPED_UNICODE));
        $this->reply($text);
    }
}