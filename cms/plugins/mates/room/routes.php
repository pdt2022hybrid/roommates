<?php

namespace Mates\Login;

use Illuminate\Support\Facades\Route;
use Mates\Login\Http\Middlewares\TokenMiddleware;
use Mates\Room\Http\Controllers\RoomController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::middleware([TokenMiddleware::class])->group(function () {
        Route::post('room/create', [RoomController::class, 'createRoom']);
        Route::get('room/join/{roomIdentifier}', [RoomController::class, 'joinRoom']);
        Route::get('room/leave', [RoomController::class, 'leaveRoom']);
        Route::post('room/miniroom/create', [RoomController::class, 'createMiniRoom']); //TODO: naozaj by si mohol pouzit tie api standarty
        Route::get('rooms/all', [RoomController::class, 'getAllRooms']);
        Route::get('room/minirooms', [RoomController::class, 'getMiniRoomsInRoom']);
        Route::get('user/room', [RoomController::class, 'getUsersRoom']);
        Route::get('room/{id}', [RoomController::class, 'getRoom']);
    });
});
