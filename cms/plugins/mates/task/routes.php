<?php


namespace Mates\Task;

use Illuminate\Support\Facades\Route;
use Mates\Login\Http\Middlewares\TokenMiddleware;
use Mates\Task\Http\Controllers\TaskController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::middleware([TokenMiddleware::class])->group(function () {
        Route::post('task/create', [TaskController::class, 'createTask']);
        Route::post('task/{id}/update', [TaskController::class, 'updateTask']);
        Route::post('task/{id}/complete', [TaskController::class, 'completeTask']);
        Route::get('task/{id}', [TaskController::class, 'findTask']);
        Route::get('tasks/room/{id}', [TaskController::class, 'findTasksByRoom']);
        Route::get('tasks/user/{id}', [TaskController::class, 'findTasksByUser']);
    });
});
