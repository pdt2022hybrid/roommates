<?php namespace Mates\Room\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateRoomsTable Migration
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
        Schema::create('mates_room_rooms', function(Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('room_count');
            $table->string('room_identifier');
            $table->integer('room_owner_id');

            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('mates_room_rooms');
    }
};
