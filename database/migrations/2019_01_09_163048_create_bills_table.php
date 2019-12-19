<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flat_id')->unsigned();
            $table->integer('rent');
            $table->integer('unit_bill');
            $table->integer('gas_bill');
            $table->integer('others_bill');
            $table->timestamps();

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
        Schema::table('bills', function(Blueprint $table){
            $table->dropForeign('bills_flat_id_foreign');
        });

        Schema::dropIfExists('bills');
    }
}
