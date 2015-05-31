<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function($table) {
		    $table->increments('id');
		    $table->integer('client_id')
		    	->unsigned()
		    	->nullable();
		    $table->foreign('client_id')
      			->references('id')->on('clients')
      			->onDelete('cascade');
		    $table->date('date');
		    $table->integer('number');
		    $table->longText('description');
		    $table->decimal('price_exc_btw',10,2);
		    $table->decimal('price_inc_btw',10,2);
		    $table->tinyInteger('paid');
		    $table->integer('project_id')
		    	->unsigned()
		    	->nullable();
		    $table->foreign('project_id')
      			->references('id')->on('projects')
      			->onDelete('cascade');
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
		Schema::dropIfExists('invoices');
	}

}
