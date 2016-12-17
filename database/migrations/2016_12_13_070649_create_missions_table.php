<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_id')->unsigned()->nullable();
            $table->string('name')->comment('名稱');
            $table->string('display_name')->comment('顯示名稱');
            $table->timestamps();

            //foreign ket Set
            $table->foreign('level_id')->references('id')->on('levels') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
