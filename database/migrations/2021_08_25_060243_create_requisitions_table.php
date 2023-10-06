<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->integer('requisition_no')->nullable();

            $table->text('reason_of_purchase')->nullable();
            $table->text('service_comment')->nullable();
            $table->text('purchase_comment')->nullable();
            $table->string('remarks', 255)->nullable();

            $table->dateTime('received_at')->nullable();

            $table->bigInteger('received_by')->unsigned()->nullable();
            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();

            $table->string('status', 2)->default('I');

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
        Schema::dropIfExists('requisitions');
    }
}
