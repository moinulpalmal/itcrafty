<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_category')->unsigned()->nullable();
            $table->bigInteger('product_sub_category')->unsigned()->nullable();
            $table->bigInteger('manufacturer')->unsigned()->nullable();

            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();

            $table->boolean('has_warranty')->default(true);
            $table->boolean('has_sl_no')->default(true);
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
        Schema::dropIfExists('product_masters');
    }
}
