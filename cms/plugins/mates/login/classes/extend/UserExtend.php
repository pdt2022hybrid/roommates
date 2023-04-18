<?php

namespace Mates\Login\Classes\Extend;

use Mates\Room\Models\Room;
use RainLab\User\Models\User;

class UserExtend
{
    public static function UserExtend() {
        User::extend(function($model) {
            $model->hasMany['rooms'] = [
                Room::class,
            ];
        });
    }
}
