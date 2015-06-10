<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function($table) {
		    $table->increments('id');
		    $table->integer('tasklist_id')
		    	->unsigned()
		    	->nullable();
		    // $table->foreign('tasklist_id')
      // 			->references('id')->on('tasklists')
      // 			->onDelete('cascade');
      		$table->longText('description');
		    $table->date('date');
		    $table->integer('hours');
		    $table->decimal('price_exc_btw',10,2);
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
		Schema::dropIfExists('tasks');
	}

}
