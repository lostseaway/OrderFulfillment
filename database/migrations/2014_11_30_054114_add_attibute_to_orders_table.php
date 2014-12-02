<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttibuteToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->string('site', 100);
			$table->string('transcation_id', 100);
			$table->integer('customer_id');
			$table->string('customer_email',100);
			$table->timestamp('invoice_date');
			$table->string('payment_type', 100);
			$table->string('order_status', 100);
			$table->string('payment_status', 100);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn('site');
			$table->dropColumn('transcation_id');
			$table->dropColumn('customer_id');
			$table->dropColumn('customer_email');
			$table->dropColumn('invoice_date');
			$table->dropColumn('payment_type');
			$table->dropColumn('order_status');
			$table->dropColumn('payment_status');
		});
	}

}
