<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('role_id');
            $table->string('name')->nullable();
            $table->string('username', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('photo_path')->nullable();
            $table->string('about_me')->nullable();
            $table->string('phone_number', 12)->nullable();
            $table->tinyInteger('is_active');
            $table->char('api_token', 60)->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
