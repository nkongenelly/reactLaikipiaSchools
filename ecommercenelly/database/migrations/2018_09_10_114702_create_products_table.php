<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('product_name');
            $table->integer('product_status');
            $table->double('product_price', 8, 2);
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('product_image')->nullable();
            $table->text('product_description');
            $table->integer('Product_quantity')->nullable();
            $table->timestamps();
        });
        // DB::table ('products')->insert(
        //     array(
        //     ['product_status' =>'In stock'],
        //     ['product_status' =>'Out of stock']
        //     )
        //     );
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
