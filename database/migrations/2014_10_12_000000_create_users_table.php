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
            $table->string('name',200);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('is_admin', ['1', '2'])->default('2');
            $table->string('password');
            $table->string('gender',8);
            $table->string('country',40);
            $table->string('profile_image',150);
            $table->enum('status', ['0', '1'])->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
