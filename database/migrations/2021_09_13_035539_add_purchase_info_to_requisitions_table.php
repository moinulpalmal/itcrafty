<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseInfoToRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            $table->dateTime('purchase_sent_at')->nullable();
            $table->dateTime('purchase_received_at')->nullable();
            $table->bigInteger('purchase_received_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            $table->dropColumn('purchase_sent_at');
            $table->dropColumn('purchase_received_at');
            $table->dropColumn('purchase_received_by');
        });
    }
}
