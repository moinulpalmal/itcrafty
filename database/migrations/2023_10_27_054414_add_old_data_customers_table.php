<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldDataCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('old_designation', 255)->nullable();
            $table->string('old_department', 255)->nullable();
            $table->string('old_section', 255)->nullable();
            $table->string('old_division', 255)->nullable();
            $table->date('joining_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('old_designation');
            $table->dropColumn('old_department');
            $table->dropColumn('old_section');
            $table->dropColumn('old_division');
            $table->dropColumn('joining_date');
        });
    }
}
