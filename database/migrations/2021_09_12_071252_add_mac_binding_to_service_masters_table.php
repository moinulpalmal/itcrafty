<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMacBindingToServiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_masters', function (Blueprint $table) {
            $table->boolean('is_mac_binding_mail_sent')->default(false);
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
            $table->dropColumn('is_mac_binding_mail_sent');
        });
    }
}
