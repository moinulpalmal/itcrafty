<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_detail_id')->unsigned()->nullable();
            $table->bigInteger('product_master_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('issue_type_id')->unsigned()->nullable();
            $table->bigInteger('issued_by')->unsigned()->nullable();
            $table->bigInteger('requisition_id')->unsigned()->nullable();

            $table->date('issue_date')->nullable();
            $table->date('release_date')->nullable();
            $table->string('issue_description', 255)->nullable();
            $table->string('reference_no', 25)->nullable();

            $table->string('remarks', 255)->nullable();

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
        Schema::dropIfExists('product_issues');
    }
}
