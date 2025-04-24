<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('tester', function () {
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
        
    /*/шлет команды для меню*/
    dd($bot->registerCommands([
        'hello' => 'говорит привет',
        'actions' => 'различные действия',
        'help' => 'что умеет этот бот',
        'shopping_list' => 'создать список покупок',
        'open_lists' => 'открыть список'
    ])->send());
});

Artisan::command('infobot', function () {
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
    /*/ информация о боте*/
    dd($bot->info());
});

Artisan::command('deletewebhook', function () {
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
    /*/ удаляет веб хук боте*/
    dd($bot->unregisterWebhook()->send());
});

