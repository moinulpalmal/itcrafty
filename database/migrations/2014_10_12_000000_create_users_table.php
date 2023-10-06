<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('employee_id')->default('6655')->nullable();
            $table->bigInteger('designation_id')->default(1)->nullable();
            $table->bigInteger('department_id')->default(1)->nullable();
            $table->bigInteger('factory_id')->default(1)->nullable();
            $table->string('personal_mobile_no')->nullable();
            $table->string('official_mobile_no')->nullable();
            $table->string('official_extension_no')->nullable();
            $table->string('profile_picture')->default('user.png')->nullable();
            $table->string('inserted_by')->default('Startup Admin')->nullable();
            $table->string('last_updated_by')->default('Startup Admin')->nullable();
            $table->boolean('approved')->default(1)->nullable();
            $table->boolean('approval_authority')->default(0)->nullable();
            $table->string('email', 150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender', 1)->default('M');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
