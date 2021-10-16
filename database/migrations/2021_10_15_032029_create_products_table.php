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
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->boolean('stock')->default(1);
            $table->integer('qty')->default(0);
            $table->string('sku');
            $table->integer('total_page_number')->default(1);
            $table->string('best_for_age')->nullable();
            $table->string('cover_type')->nullable();
            $table->integer('shipping_day_from')->nullable();
            $table->integer('shipping_day_to')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('products');
    }
}
