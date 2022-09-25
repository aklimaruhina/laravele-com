<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('short_description');
            $table->longText('long_description');
            $table->string('product_code');
            $table->float('amount', 10, 2);
            $table->integer('featured')->default(0);
            $table->float('unit_amount', 10, 2);
            $table->string('type');
            $table->integer('total_stock');
            $table->integer('min_order');
            $table->string('color');
            $table->string('slug');
            $table->string('product_img');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
};
