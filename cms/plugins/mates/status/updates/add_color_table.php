<?php namespace Mates\Status\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateStatusesTable Migration
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
        Schema::table('mates_status_statuses', function(Blueprint $table) {
            $table->string('color')->nullable();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        if(Schema::hasTable('mates_status_statuses')) {
            Schema::table('mates_status_statuses', function (Blueprint $table) {
                $table->dropColumn('color');
            });
        }
    }
};

//TODO: clearni subor
