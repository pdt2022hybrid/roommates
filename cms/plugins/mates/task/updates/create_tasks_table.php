<?php namespace Mates\Task\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTasksTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('mates_task_tasks', function(Blueprint $table) {
            $table->id();

            $table->integer('room_id')->nullable();
            $table->integer('miniroom_id')->nullable(); // mozno name ale potom room_ids
            $table->integer('status_id')->nullable(); // mozno name
            $table->integer('user_created_id')->nullable();
            $table->integer('user_assigned_id')->nullable(); // mozno name

            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamp('deadline')->nullable();
            //$table->integer('promised_completion_date')->nullable();
            //$table->timestamp('auto_cancel_date')->nullable();
            //TODO: neskorsie $table->string('priority')->nullable();

            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('mates_task_tasks');
    }
};
