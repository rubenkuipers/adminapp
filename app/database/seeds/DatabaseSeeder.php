<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('CommentTableSeeder');
		// $this->command->info('Comment table seeded.');
		
		// $this->call('ClientTableSeeder');
		// $this->command->info('Client table seeded.');

		// $this->call('CategoryTableSeeder');
		// $this->command->info('Category table seeded.');
		
		// $this->call('TasklistTableSeeder');
		// $this->command->info('Tasklist table seeded.');

		$this->call('ProjectTableSeeder');
		$this->command->info('Project table seeded.');

		// $this->call('InvoiceTableSeeder');
		// $this->command->info('Invoice table seeded.');
		

	}

}