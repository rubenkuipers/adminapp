<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function($table) {
		    $table->increments('id');
		    $table->string('name');
		    $table->string('adress');
		    $table->char('zipcode');
		    $table->string('city');
		    $table->string('website');
		    $table->string('email');
		    $table->string('phone');
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
		Schema::dropIfExists('clients');
	}

}
