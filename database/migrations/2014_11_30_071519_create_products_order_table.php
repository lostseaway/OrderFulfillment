<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_order', function($table)
	    {
	    	$table->increments('id');
	    	$table->integer('order_id')->unsigned();
			$table->foreign('order_id')->references('id')->on('orders');
			$table->integer('product_id')->unsigned();
			$table->string('product_name',200);
			$table->float('price');
			$table->integer('quantity');
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
		Schema::drop('products_order');
	}

}
