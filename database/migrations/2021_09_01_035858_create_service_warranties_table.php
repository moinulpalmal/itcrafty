<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_warranties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_master')->unsigned()->nullable();
            $table->bigInteger('vendor')->unsigned()->nullable();
            $table->bigInteger('service_mail')->unsigned()->nullable();

            $table->text('problem_description')->nullable();

            $table->date('generated_at')->nullable();
            $table->date('mailed_at')->nullable();
            $table->date('sent_at')->nullable();
            $table->date('received_at')->nullable();
            $table->date('delivered_at')->nullable();

            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();

            $table->text('remarks')->nullable();

            $table->string('status', 3)->default('I');
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
        Schema::dropIfExists('service_warranties');
    }
}
