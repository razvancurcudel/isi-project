<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->float("lat", 17, 15);
            $table->float("long", 17, 15);
            $table->text("description");
            $table->timestamp("start_timestamp")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("end_timestamp")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
