<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestEmailTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_email_tos', function (Blueprint $table) {
            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->integer('counter')->unsigned()->nullable();

            $table->integer('service_request')->unsigned()->nullable();
            $table->string('type')->nullable()->default('cc');
            $table->string('email')->nullable();

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
        Schema::dropIfExists('service_request_email_tos');
    }
}
