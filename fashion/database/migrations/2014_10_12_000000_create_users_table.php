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
            $table->string('uuid')->index();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->unique()->index();
            $table->string('email')->index()->nullable();
            $table->string('phone')->index()->nullable();
            $table->string('code_country')->index()->nullable();
            $table->string('language_id')->index()->nullable();
            $table->text('about_me')->nullable();
            $table->text('specialty_me')->nullable();
            $table->string('code_confirm')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('birth_month')->nullable();
            $table->string('birth_year')->nullable();
            $table->string('birthday')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
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
