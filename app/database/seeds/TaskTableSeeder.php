<?php

class TaskTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('tasks')->delete();

		Task::create(array(
			'tasklist_id' => 2,
			'date' => '2013-04-19 09:55:32',
			'description' => 'Added some styles to the website. Very exclusive ones.',
			'hours' => 2,
			'price_exc_btw' => 60,
		));

		Task::create(array(
			'tasklist_id' => 2,
			'date' => '2013-04-20 09:55:32',
			'description' => 'New logo design.',
			'hours' => 3.5,
			'price_exc_btw' => 105,
		));

		Task::create(array(
			'tasklist_id' => 3,
			'date' => '2014-04-14 09:55:32',
			'description' => 'Funny new website',
			'hours' => 20,
			'price_exc_btw' => 600,
		));

		Task::create(array(
			'tasklist_id' => 4,
			'date' => '2014-06-14 09:55:32',
			'description' => 'did a good job',
			'hours' => 4.5,
			'price_exc_btw' => 135,
		));
	}

}