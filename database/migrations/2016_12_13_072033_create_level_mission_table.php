<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_mission', function (Blueprint $table) {
            $table->increments('id');
            $tabel->integer('level_id')->unsigned()->index();
            $tabel->integer('mission_id')->unsigned()->index();
            $table->timestamps();

            //foreign key Set
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('mission_id')->references('id')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_mission');
    }
}
