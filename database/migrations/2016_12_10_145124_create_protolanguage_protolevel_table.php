<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtolanguageProtolevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protolanguage_protolevel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('protolanguage_id')->unsigned()->index();
            $table->integer('protolevel_id')->unsigned()->index();
            $table->timestamps();

            //foreign Key Set
            $table->foreign('protolanguage_id')->references('id')->on('protolanguages');
            $table->foreign('protolevel_id')->references('id')->on('protolevels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protolanguage_protolevel');
    }
}
