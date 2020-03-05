<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->bigInteger('user_id');
            $table->string('manager');
            $table->string('phones')->nullable();
            $table->integer('country_id')->default(0);
            $table->integer('state_id')->default(0);
            $table->integer('city_id')->default(0);
            $table->text('address')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('about')->nullable();
            $table->decimal('shipping_cost',16,2)->nullable();
            $table->integer('time_transfor')->default(0);
            $table->timestamp('tell_verified_at')->nullable();
            $table->timestamp('active_verified_at')->nullable();
            $table->integer('sell_online')->default(0); // forosh online
            $table->integer('sell_in_person')->default(0); // forosh hozori
            $table->integer('pay_in_person')->default(0); // forosh hozori
            $table->integer('pay_cart')->default(0); // forosh hozori
            $table->integer('pay_online')->default(0); // forosh hozori
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::create('seller_sosial', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('sosial_id');
            $table->text('link');

            $table->primary(['seller_id','sosial_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('seller_sosial');
    }
}
