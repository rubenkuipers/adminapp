<?php

class CategoryTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('categories')->delete();

		Category::create(array(
			'name' => 'Design',
		));

		Category::create(array(
			'name' => 'Development',
		));

		Category::create(array(
			'name' => 'DTP',
		));

		Category::create(array(
			'name' => 'SEO',
		));
	}

}