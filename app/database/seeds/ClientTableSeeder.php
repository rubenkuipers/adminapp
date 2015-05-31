<?php

class ClientTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('clients')->delete();

		Client::create(array(

			'name' => 'Ruben Kuipers',
			'adress' => 'Mondriaanlaan 32',
			'zipcode' => '1701TD',
			'city' => 'Heerhugowaard',
			'website' => 'www.rkmediadesign.nl',
			'email' => 'info@rkmediadesign.nl',
			'phone' => '0657041096'
		));

		Client::create(array(

			'name' => 'Dineke Kuipers',
			'adress' => 'Mondriaanlaan 32',
			'zipcode' => '1701TD',
			'city' => 'Heerhugowaard',
			'website' => 'www.test.nl',
			'email' => 'info@freedom.nl',
			'phone' => '0657431096'
		));

		Client::create(array(

			'name' => 'Timo Kuipers',
			'adress' => 'Mondriaanlaan 32',
			'zipcode' => '1701TD',
			'city' => 'Heerhugowaard',
			'website' => 'www.hallo.nl',
			'email' => 'info@hotmail.nl',
			'phone' => '065780745'
		));

	}

}