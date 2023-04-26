<?php

namespace Mates\Task\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;
use Mates\Room\Models\Miniroom;
use Mates\Task\Http\Resources\TaskResource;
use Mates\Task\Models\Task;
use RainLab\User\Models\User;

class TaskController extends Controller
{
    public function createTask(Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        $postData = [
            'user_assigned_id' => post('user_assigned_id'),
            'user_created_id' => $user->id,
            'miniroom_id' => post('miniroom_id'),
            'status_id' => post('status_id'),
            'task_name' => post('task_name'),
            'task_description' => post('task_description'),
            'deadline' => post('deadline'),
        ];

        $miniRoom = Miniroom::where('id', $postData['miniroom_id'])->first();

        if(!$miniRoom) {
            return response()->json([
                'error' => 'Miniroom not found'
            ], 404);
        }

        $task = new Task();
        $task->user_assigned_id = $postData['user_assigned_id'];
        $task->user_created_id = $postData['user_created_id'];
        $task->miniroom_id = $postData['miniroom_id'];
        $task->room_id = $miniRoom->room_id;
        $task->status_id = $postData['status_id'];
        $task->name = $postData['task_name'];
        $task->description = $postData['task_description'];
        $task->deadline = $postData['deadline'];
        $task->save();

        return new TaskResource($task); //TODO: Topolsky dorob Task Resource a vratit ho
    }

    public function updateTask($id, Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        $task = Task::where('id', $id)->first();

        if(!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        $postData = [
            'user_assigned_id' => post('user_assigned_id'),
            'user_created_id' => $user->id,
            'miniroom_id' => post('miniroom_id'),
            'status_id' => post('status_id'),
            'task_name' => post('task_name'),
            'task_description' => post('task_description'),
            'deadline' => post('deadline'),
        ];

        $miniRoom = Miniroom::where('id', $postData['miniroom_id'])->first();

        if(!$miniRoom) {
            return response()->json([
                'error' => 'Miniroom not found'
            ], 404);
        }


        $task->user_assigned_id = $postData['user_assigned_id'];
        $task->user_created_id = $postData['user_created_id'];
        $task->miniroom_id = $postData['miniroom_id'];
        $task->room_id = $miniRoom->room_id;
        $task->status_id = $postData['status_id'];
        $task->name = $postData['task_name'];
        $task->description = $postData['task_description'];
        $task->deadline = $postData['deadline'];
        $task->save();

<<<<<<< Updated upstream
        return new TaskResource($task); //TODO: Topolsky dorob Task Resource a vratit ho
=======
        return newTaskResource($task); //TODO: Topolsky dorob Task Resource a vratit ho
>>>>>>> Stashed changes
    }

    public function completeTask(Request $request) {

        $postData = [
            'task_id' => post('task_id'),
        ];

        $task = Task::where('id', $postData['task_id'])->first();

        if(!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        $task->status_id = 3;
        $task->save();

        return new TaskResource($task);//TODO: Topolsky dorob Task Resource a vratit ho
    }

    public function findTask($id, Request $request) {
        $task = Task::where('id', $id)->first();

        if(!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        return new TaskResource($task); // TODO: Topolsky prerob na vracanie resource
    }

    public function findTasksByRoom($id, Request $request) {
        $tasks = Task::where('room_id', $id)->whereNot('status_id', 3)->get();

        if(!$tasks) {
            return response()->json([
                'error' => 'Tasks not found'
            ], 404);
        }

        return new TaskResource($tasks); // TODO: Topolsky prerob na vracanie resource (collection)
    }

    public function findTasksByUser($id, Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        $tasks = Task::where('user_assigned_id', $id)->get();

        if(!$tasks) {
            return response()->json([
                'error' => 'Tasks not found'
            ], 404);
        }

        return new TaskResource($tasks);// TODO: Topolsky prerob na vracanie resource (collection)
    }
}
