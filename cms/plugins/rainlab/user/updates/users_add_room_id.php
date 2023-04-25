<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UsersAddRoomId extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->integer('room_id')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'surname')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('room_id');
            });
        }
    }
}
