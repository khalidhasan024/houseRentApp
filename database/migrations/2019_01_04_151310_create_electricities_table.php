<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectricitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electricities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flat_id')->unsigned();
            $table->timestamp('date');
            $table->integer('start_reading');
            $table->integer('end_reading');

            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('electricities',function(Blueprint $table){
            $table->dropForeign('electricities_flat_id_foreign');
        });
        Schema::dropIfExists('electricities');
    }
}
