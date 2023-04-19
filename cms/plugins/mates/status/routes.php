<?php

namespace Mates\Status;

use Illuminate\Support\Facades\Route;
use Mates\Login\Http\Middlewares\TokenMiddleware;
use Mates\Status\Http\controllers\StatusController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::middleware([TokenMiddleware::class])->group(function () {
        Route::get('status/all', [StatusController::class, 'index']);
    });
});
