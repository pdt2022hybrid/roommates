<?php
namespace Mates\Login;

use Illuminate\Support\Facades\Route;
use Mates\Login\Http\Controllers\SignUpController;

Route::group(['prefix' => 'api/auth'], function () {
    Route::post('signup', [SignUpController::class, 'signup']);
    Route::post('login', [SignUpController::class, 'login']);
    //Route::post(uri:'avatar'[SignUpController::class'avatar']);, TOTO NEVIEM CI BUDE TREBA SEM DAT, CI SA MA VYTVORIT NOVA ROUTA NA PROFILE PIC
});
