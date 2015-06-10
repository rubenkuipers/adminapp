<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasklists', function($table) {
		    $table->increments('id');
		    $table->integer('project_id')
		    	->unsigned()
		    	->nullable();
		    // $table->foreign('project_id')
      // 			->references('id')->on('projects')
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
		Schema::dropIfExists('tasklists');
	}

}
