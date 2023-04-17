<?php


namespace Mates\Task;

use Illuminate\Support\Facades\Route;
use Mates\Login\Http\Middlewares\TokenMiddleware;
use Mates\Task\Http\Controllers\TaskController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::middleware([TokenMiddleware::class])->group(function () {
        Route::post('task/create', [TaskController::class, 'createTask']);
        Route::post('task/{id}/update', [TaskController::class, 'updateTask']);
        Route::post('task/complete', [TaskController::class, 'completeTask']);
        Route::post('task/{id}', [TaskController::class, 'findTask']);
        Route::post('tasks/room/{id}', [TaskController::class, 'findTasksByRoom']);
        Route::post('tasks/user/{id}', [TaskController::class, 'findTasksByUser']);
        //TODO: naozaj by si mohol pouzit tie api standarty,
        // https://laravel.com/docs/5.5/controllers#resource-controllers
        //https://stackoverflow.com/questions/23505875/laravel-routeresource-vs-routecontroller
    });
});
