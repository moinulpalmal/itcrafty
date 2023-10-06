<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendor')->unsigned()->nullable();
            $table->string('name', 150)->nullable();
            $table->string('designation', 150)->nullable();
           // $table->string('email', 150)->nullable();
            $table->string('contact_no', 255)->nullable();
            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('vendor_people');
    }
}
