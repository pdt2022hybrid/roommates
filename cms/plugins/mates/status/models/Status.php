<?php namespace Mates\Status\Models;

use Mates\Task\Models\Task;
use Model;

/**
 * Status Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Status extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_status_statuses';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $hasMany = [
        'tasks' => [
            Task::class
        ]
    ];
}
