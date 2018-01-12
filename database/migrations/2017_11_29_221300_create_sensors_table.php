<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("identifier");
            $table->string("collection_point");
            $table->float('long', 8, 5);
            $table->float('lat', 8, 5);
            $table->float('nitrate', 5, 2);
            $table->float('ph', 4, 2);
            $table->float('conductivity', 5, 2);
            $table->float('salinity', 5, 2);
            $table->float('turbidity', 5, 2);
            $table->integer('tds');
			$table->float('gh', 5, 2);
            $table->timestamp("update_timestamp")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensors');
    }
}
