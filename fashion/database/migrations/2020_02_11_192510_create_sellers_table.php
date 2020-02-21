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
            $table->string('phones');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->text('address');
            $table->text('about')->nullable();
            $table->integer('shipping_cost')->default(0);
            $table->integer('time_transfor')->default(0);
            $table->integer('active')->default(1);
            $table->integer('active_admin')->default(0);
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
