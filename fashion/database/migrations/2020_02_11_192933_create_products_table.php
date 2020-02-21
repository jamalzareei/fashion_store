<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->bigInteger('user_id');
            $table->bigInteger('seller_id');
            $table->integer('active')->default(1);
            $table->integer('active_admin')->default(0);
            $table->string('description_short')->nullable();
            $table->string('description_full')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('category_product', function (Blueprint $table) {
            $table->bigInteger('category_id');
            $table->bigInteger('product_id');
        });
        Schema::create('extra_feild_product', function (Blueprint $table) {
            $table->bigInteger('extra_feild_id');
            $table->bigInteger('product_id');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('extra_feild_product');
    }
}
