<?php

class InvoiceTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('invoices')->delete();

		Invoice::create(array(

			'client_id' => 1,
			'date' => '2013-04-19 09:55:32',
			'number' => 50,
			'description' => 'Webdesign for Aanloophuis',
			'price_exc_btw' => 875.50,
			'price_inc_btw' => 900,
			'paid' => false,
		));

		Invoice::create(array(

			'client_id' => 2,
			'date' => '2014-04-19 09:55:32',
			'number' => 51,
			'description' => 'development for Someone',
			'price_exc_btw' => 30,
			'price_inc_btw' => 45,
			'paid' => true,
		));
	}

}