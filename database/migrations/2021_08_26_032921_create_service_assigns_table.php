<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_assigns', function (Blueprint $table) {
            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->integer('counter')->unsigned()->nullable();

            $table->bigInteger('assigned_to')->unsigned()->nullable();

            $table->text('assignment_description')->nullable();
            $table->date('assign_date')->nullable();

            $table->text('clearance_description')->nullable();
            $table->date('clearance_date')->nullable();

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
        Schema::dropIfExists('service_assigns');
    }
}
