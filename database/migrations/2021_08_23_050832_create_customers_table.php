<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id', 20)->nullable();

            $table->bigInteger('factory')->unsigned()->nullable();
            $table->bigInteger('designation')->unsigned()->nullable();
            $table->bigInteger('department')->unsigned()->nullable();

            $table->string('job_location', 150)->nullable();

            $table->string('name', 255)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('mobile_no', 11)->nullable();
            $table->string('ext_no', 4)->nullable();

            $table->boolean('is_factory_it')->default(false);

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
        Schema::dropIfExists('customers');
    }
}
