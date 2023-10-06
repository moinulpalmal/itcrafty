<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id')->unsigned()->nullable();

            $table->bigInteger('customer')->unsigned()->nullable();
            $table->string('contact_no', 255)->nullable();
            $table->string('contact_email', 255)->nullable();

            $table->bigInteger('product_master')->unsigned()->nullable();
            $table->bigInteger('product_detail')->unsigned()->nullable();

            $table->text('problem_description')->nullable();
            $table->text('solution_description')->nullable();

            $table->dateTime('received_at')->nullable();
            $table->dateTime('solved_at')->nullable();
            $table->dateTime('delivered_at')->nullable();

            $table->bigInteger('received_by')->unsigned()->nullable();
            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('delivered_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();

            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('service_masters');
    }
}
