<?php

namespace Mates\User\Http\Controllers;

use Backend\Classes\Controller;
use RainLab\User\Models\User;
use Mates\User\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        return new UserResource($user);
    }

    public function getRoomUsers($id) {
        $users = User::where('room_id', $id)->get();

        return UserResource::collection($users);
    }
}
