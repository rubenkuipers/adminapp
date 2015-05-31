<?php

class ProjectTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('projects')->delete();

		Project::create(array(

			'category_id' => 1,
			'client_id' => 1,
			'description' => 'Webdesign for Aanloophuis',
			'price_method' => 'solid',
			'sales_tax' => 21,
			'price' => 875.50,
			'tasklist_id' => 2,
			'total_price' => 875.50,
			'delivery_date' => '2013-04-19 09:55:32',
			'finished' => false,
			'invoice_id' => 03,
		));

		Project::create(array(

			'category_id' => 2,
			'client_id' => 2,
			'description' => 'development for Someone',
			'price_method' => 'hourly',
			'sales_tax' => 21,
			'price' => 30,
			'tasklist_id' => 2,
			'total_price' => 60,
			'delivery_date' => '2014-04-19 09:55:32',
			'finished' => true,
			'invoice_id' => 4,
		));
	}

}