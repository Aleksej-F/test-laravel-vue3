<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    MailController, 
    FacilityController,
    SliderController,
    TestsController,
    ImageController,
    VideoController,
    TaskController,
    TaskListController,
    PHPMailerController,
    UsersController
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')
    ->as('api.')
    ->group(function () {
        Route::apiResource('facility', FacilityController::class)->only([
            'index', 'show'
        ]);
        Route::apiResource('slider', SliderController::class);
        Route::apiResource('tests', TestsController::class);
        // Route::apiResource('users', UserController::class);
        // Route::post('image/save', [ImageController::class, 'index']);
        Route::get('greeting', function () {
            return 'Hello World!!!';
        });
        // Route::g('facility', FacilityController::class);
        Route::post('facilitys', [FacilityController::class, 'index']);
        Route::post('catalog', [ImageController::class, 'catalog'])->middleware('auth:sanctum');
        Route::apiResource('image', ImageController::class)->middleware('auth:sanctum');
        Route::apiResource('video', VideoController::class)->middleware('auth:sanctum');
        Route::apiResource('facility', FacilityController::class)->except([
            'index', 'show'
        ])->middleware('auth:sanctum');

        Route::post("send-email", [PHPMailerController::class, "composeEmail"])->name("send-email");
    });

   
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UsersController::class);
        Route::apiResource('tasklist', TaskListController::class );
        Route::apiResource('tasks', TaskController::class );
        Route::post('tasklist/update',[TaskListController::class, "tasklistUpdate"]);
        Route::post('tasklist/share',[TaskListController::class, "tasklistShare"]);
        Route::post('tasklist/append/{id}',[TaskListController::class, "tasklistAppend"]);
       
});

Route::get('tasklist/share/{id}',[TaskListController::class, "getTasklistShare"]);

Route::post('semdmail', [MailController::class, 'sendMail']);

// Route::prefix('v1')
// ->as('api.')
// ->post('greeting', function () {
//     return 'Hello World';
// });

