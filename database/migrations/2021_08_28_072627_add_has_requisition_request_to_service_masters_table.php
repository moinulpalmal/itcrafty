<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasRequisitionRequestToServiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_masters', function (Blueprint $table) {
            $table->boolean('has_requisition_request')->default(false);
            $table->boolean('has_assigned')->default(false);
            $table->boolean('has_warranty')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_masters', function (Blueprint $table) {
            $table->dropColumn('has_requisition_request');
            $table->dropColumn('has_assigned');
            $table->dropColumn('has_warranty');
        });
    }
}
