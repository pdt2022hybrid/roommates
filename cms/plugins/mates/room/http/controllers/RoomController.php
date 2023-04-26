<?php

namespace Mates\Room\Http\Controllers;

use Backend\Classes\Controller;
use Mates\Room\Http\resources\MiniRoomResource;
use Mates\Room\Models\Miniroom;
use RainLab\User\Models\User;
use Mates\Room\Models\Room;
use Illuminate\Http\Request;
use Mates\Room\Http\Resources\RoomResource;

class RoomController extends Controller
{
    public function getAllRooms(Request $request) {
        return new RoomResource(Room::all());
    }
    public function createRoom(Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        $postData = [
            'room_name' => post('room_name'),
            'room_owner_id' => $user->id,
        ];
        $room = new Room();
        $room->name = $postData['room_name'];
        $room->room_count = 0;
        $room->room_owner_id = $postData['room_owner_id'];
        $room->save();

        $user->room_id = $room->id;
        $user->save();

        $miniRooms = collect();

        if (post('izby')) {
            foreach (post('izba') as $name) {
                $room->room_count++;
                $room->save();
                $miniRoom = new Miniroom();
                $miniRoom->room_id = $room->id;
                $miniRoom->name = $name;
                $miniRoom->save();
                $miniRooms->push($miniRoom);
            }
        }

        return new RoomResource($room);
    }

//    public function createMiniRoom(Request $request)
//    {
//        $room_id = User::where('id', $request->get('tokenUserID'))->first()->room_id;
//        $room = Room::where('id', $room_id)->first();
//
//        if (!$room) {
//            return response()->json([
//                'error' => 'Room not found SUPPLIED ROOM_ID: ' . $room_id
//            ], 404);
//        }
//
//        $room->room_count++;
//        $room->save();
//        $miniRooms = collect();
//
//        foreach (post('izba_name') as $name) {
//            $miniRoom = new Miniroom();
//            $miniRoom->room_id = $room_id;
//            $miniRoom->name = $name;
//            $miniRoom->save();
//            $miniRooms->push($miniRoom);
//        }
//        return MiniRoomResource::collection($miniRooms);
//    }

    public function getAllMiniRooms(Request $request) {
        return new MiniRoomResource(Miniroom::all());
    }

    public function getRoom($id) {
        return new RoomResource(Room::where('id', $id)->firstOrFail());
    }

    public function getMiniRoom($id) {
        return new RoomResource(Miniroom::where('id', $id)->firstOrFail());
    }
}
