<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flat_id')->unsigned();
            $table->string('name',255);
            $table->string('profession',255);
            $table->string('status',10);
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
        Schema::table('tenants', function(Blueprint $table){
            $table->dropForeign('tenants_flat_id_foreign');
        });

        Schema::dropIfExists('tenants');
    }
}
