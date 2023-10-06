<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_emails', function (Blueprint $table) {
            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->integer('counter')->unsigned()->nullable();

            $table->integer('service_request')->unsigned()->nullable();

            $table->text('email_description')->nullable();
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
        Schema::dropIfExists('service_request_emails');
    }
}
