<?php namespace Mates\Room\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateMiniroomsTable Migration
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
        Schema::create('mates_user_room', function(Blueprint $table) {
            $table->id();

            $table->integer('user_id')->nullable();
            $table->integer('room_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('mates_user_room');
    }
};
