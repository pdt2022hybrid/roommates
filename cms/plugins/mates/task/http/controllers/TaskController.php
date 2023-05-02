<?php

namespace Mates\Task\Http\Controllers;

use Backend\Classes\Controller;
use Carbon\Carbon;
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
            'deadline' => Carbon::make(post('deadline')),
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

        return new TaskResource($task);
    }

    public function updateTask($id, Request $request) {
        $task = Task::where('id', $id)->first();

        if(!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        if (post('user_assigned_id')) $task->user_assigned_id = post('user_assigned_id');
        if (post('user_created_id')) $task->user_created_id = post('user_created_id');
        if (post('miniroom_id')) $task->miniroom_id = post('miniroom_id');
        if (post('status_id')) $task->status_id = post('status_id');
        if (post('task_name')) $task->name = post('task_name');
        if (post('task_description')) $task->description = post('task_description');
        if (post('deadline')) $task->deadline = post('deadline');

        $task->save();

        return new TaskResource($task);
    }

    public function completeTask($id) {
        $task = Task::where('id', $id)->first();

        if(!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        $task->status_id = 3;
        $task->save();

        return new TaskResource($task);
    }

    public function findTask($id) {
        $task = Task::where('id', $id)->first();

        if(!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        return new TaskResource($task);
    }

    public function findTasksByRoom($id) {
        $tasks = Task::where('room_id', $id)->whereNot('status_id', 3)->get();

        if(!$tasks) {
            return response()->json([
                'error' => 'Tasks not found'
            ], 404);
        }

        return TaskResource::collection($tasks);
    }

    public function findTasksByUser($id) {
        $tasks = Task::where('user_assigned_id', $id)->get();

        if(!$tasks) {
            return response()->json([
                'error' => 'Tasks not found'
            ], 404);
        }

        return TaskResource::collection($tasks);
    }
}
