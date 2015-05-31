<?php

class TasklistTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('tasklists')->delete();

		Tasklist::create(array(
		));

		Tasklist::create(array(
		));

		Tasklist::create(array(
		));

		Tasklist::create(array(
		));
	}

}