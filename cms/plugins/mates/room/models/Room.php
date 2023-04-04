<?php namespace Mates\Room\Models;

use Model;
use Mates\Task\Models\Task;

/**
 * Room Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Room extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_room_rooms';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $hasMany = [
        'miniroom' => [
            Miniroom::class,
        ],
        'tasks' => [
            Task::class,
        ]
    ];
}
