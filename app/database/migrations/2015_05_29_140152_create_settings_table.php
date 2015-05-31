<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function($table) {
		    $table->increments('id');
		    $table->string('name');
		    $table->string('adress');
		    $table->char('zipcode');
		    $table->string('city');
		    $table->string('website');
		    $table->string('email');
		    $table->string('phone');
		    $table->string('btw_nr');
		    $table->string('kvk_nr');
		    $table->string('iban');
		    $table->string('bic_nr');
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
		Schema::dropIfExists('settings');
	}

}
