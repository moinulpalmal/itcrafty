<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSolversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_solvers', function (Blueprint $table) {

            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->integer('counter')->unsigned()->nullable();

            $table->bigInteger('solver')->unsigned()->nullable();

            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->bigInteger('inserted_by')->unsigned()->nullable();

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
        Schema::dropIfExists('service_solvers');
    }
}
