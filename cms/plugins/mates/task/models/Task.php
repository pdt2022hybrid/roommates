<?php namespace Mates\Task\Models;

use Mates\Status\Models\Status;
use Model; //TODO: ked nahradis "Model" z "October\Rain\Database\Model" tak to lepsie doplna veci
use Mates\Room\Models\Room;
use Mates\Room\Models\Miniroom;
use RainLab\User\Models\User;

//TODO: clearni si kazdy model file od picovin

/**
 * Task Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Task extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_task_tasks';

    /**
     * @var array rules for validation
     */
    public $rules = []; //TODO: toto pouzivaj, kedze sa tieto veci vytvaraju cez API tak by si mal checknut ci vsetky data su ok, na FE sa mozu stat picoviny a ty nechces aby to hadzalo random error, ale nieco pekne
    // tu je link https://docs.octobercms.com/3.x/extend/services/validation.html#basic-usage

    //TODO: nebal by som sa pouzit wapi/apiexception alebo si spravit nieco vlastne podobne, kedze tu mas vela endpointov, apiexception si pozri na wgride

    public $belongsTo = [
        'room' => [
            Room::class,
            'key' => 'room_id',
        ],
        'miniroom' => [
            Miniroom::class,
            'key' => 'miniroom_id',
        ],
        'status' => [
            Status::class,
            'key' => 'status_id',
        ],
        'user' => [
            User::class,
            'key' => 'user_created_id',
        ],
        'user_assigned' => [
            User::class,
            'key' => 'user_assigned_id',
        ],
    ];
}
