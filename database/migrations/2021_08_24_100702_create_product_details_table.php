<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_master')->unsigned()->nullable();
            $table->bigInteger('vendor')->unsigned()->nullable();

            $table->string('old_name', 255)->nullable();
            $table->string('old_vendor', 255)->nullable();
            $table->string('old_purchase_date', 255)->nullable();
            $table->string('sl_no', 255)->nullable();

            $table->date('purchase_date')->nullable();
            $table->integer('warranty_in_months')->nullable();

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
        Schema::dropIfExists('product_details');
    }
}
