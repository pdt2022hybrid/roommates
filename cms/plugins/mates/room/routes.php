<?php

namespace Mates\Login;

use Illuminate\Support\Facades\Route;
use Mates\Login\Http\Middlewares\TokenMiddleware;
use Mates\Room\Http\Controllers\RoomController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::middleware([TokenMiddleware::class])->group(function () {
        Route::post('room/create', [RoomController::class, 'createRoom']);
        Route::post('room/join', [RoomController::class, 'joinRoom']);
        Route::post('room/miniroom/create', [RoomController::class, 'createMiniRoom']); //TODO: naozaj by si mohol pouzit tie api standarty
        Route::get('rooms/all', [RoomController::class, 'getAllRooms']);
        Route::get('minirooms/all', [RoomController::class, 'getAllMiniRooms']);
        Route::get('rooms/{id}', [RoomController::class, 'getRoom']);
        Route::get('minirooms/{id}', [RoomController::class, 'getMiniRoom']);

        //TODO: Route na joinnutie pravdepodobne vytvori nejake ID roomke z ktoreho sa sprvi URL
        //TODO: Toto url presmeruje s datami roomky na FE, ktory uz len posle request na signup usera a nasledne na join
    });
});
