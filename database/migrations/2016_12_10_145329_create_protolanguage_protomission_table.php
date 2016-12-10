<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtolanguageProtomissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protolanguage_protomission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('protolanguage_id')->unsigned()->index();
            $table->integer('protomission_id')->unsigned()->index();
            $table->timestamps();

            //foreign Key Set
            $table->foreign('protolanguage_id')->references('id')->on('protolanguages');
            $table->foreign('protomission_id')->references('id')->on('protomissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protolanguage_protomission');
    }
}
