<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();

            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->bigInteger('inserted_by')->unsigned()->nullable();

            $table->string('status', 2)->default('A');
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
        Schema::dropIfExists('service_request_types');
    }
}
