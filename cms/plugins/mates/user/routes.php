<?php
namespace Mates\User;

use Illuminate\Support\Facades\Route;
use Mates\User\Http\Controllers\UserController;
use Mates\Login\Http\Middlewares\TokenMiddleware;

Route::group(['prefix' => 'api/v1'], function () {
    Route::middleware([TokenMiddleware::class])->group(function() {
        Route::get('user', [UserController::class, 'getUser']);
        Route::get('room/{id}/users', [UserController::class, 'getRoomUsers']); // FIXNI
    });
});
