<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('factory_name', 255)->nullable();
            $table->string('factory_short_name', 50)->nullable();
            $table->string('unit_name', 255)->nullable();
            $table->string('unit_short_name', 50)->nullable();
            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->boolean('department_applicable')->default(false);
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
        Schema::dropIfExists('factories');
    }
}
