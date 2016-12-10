<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtomissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protomissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('protolevel_id')->unsigned();
            $table->string('name')->comment('名稱');
            $table->string('display_name')->comment('顯示名稱');

            //foreign Key Set
            $table->foreign('protolevel_id')->references('id')->on('protolevels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protomissions');
    }
}
