<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table) {
		    $table->increments('id');
		    $table->longText('description');
		    $table->string('price_method');
		    $table->integer('sales_tax');
		    $table->decimal('price',10,2);
		    $table->decimal('total_price',10,2)->nullable();
		    $table->date('delivery_date');
		    $table->tinyInteger('finished');

		    $table->integer('category_id')
		    	->unsigned()
		    	->nullable();
		    // $table->foreign('category_id')
      // 			->references('id')->on('categories')
      // 			->onDelete('cascade');

		    $table->integer('client_id')
		    	->unsigned()
		    	->nullable();
		    // $table->foreign('client_id')
      // 			->references('id')->on('clients')
      // 			->onDelete('cascade');

      		$table->integer('tasklist_id')
		    	->unsigned()
		    	->nullable();
		    // $table->foreign('tasklist_id')
      // 			->references('id')->on('tasklists')
      // 			->onDelete('cascade');

		    $table->integer('invoice_id')
		    	->unsigned()
		    	->nullable();
		    // $table->foreign('invoice_id')
      // 			->references('id')->on('invoices')
      // 			->onDelete('cascade');
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
		Schema::dropIfExists('projects');
	}

}
