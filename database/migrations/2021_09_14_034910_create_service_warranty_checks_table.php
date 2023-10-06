<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceWarrantyChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_warranty_checks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->bigInteger('product_master')->unsigned()->nullable();
            $table->bigInteger('product_detail')->unsigned()->nullable();

            $table->integer('counter')->unsigned()->nullable();
            $table->string('warranty_status', 2)->default('NT');
            $table->boolean('is_warranty_requested')->default(false);
            $table->boolean('is_parts_warranty_check')->default(false);

            $table->string('serial_no', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('service_warranty_checks');
    }
}
