<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('user_id');
            $table->string('manager');
            $table->string('phones');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->text('address');
            $table->text('about')->nullable();
            $table->integer('active')->default(1);
            $table->integer('active_admin')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sosial_supplyer', function (Blueprint $table) {
            $table->unsignedBigInteger('supplyer_id');
            $table->unsignedBigInteger('sosial_id');

            $table->primary(['supplyer_id','sosial_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('sosial_supplyer');
    }
}
