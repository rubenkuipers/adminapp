<?php

class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Client::with('projects.category')->get());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	// public function create()
	// {
	// 	//
	// }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Client::create(array(
            'name' => Input::get('name'),
            'adress' => Input::get('adress'),
            'zipcode' => Input::get('zipcode'),
            'city' => Input::get('city'),
            'website' => Input::get('website'),
            'email' => Input::get('email'),
            'phone' => Input::get('phone')
        ));
    
        return Response::json(array('success' => true));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = Client::with('projects.category')->get()->find($id);
		return Response::json($client);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function edit($id)
	// {
	// 	//
	// }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$client = Client::find($id);
		$client->name = Input::get('name');
        $client->adress = Input::get('adress');
        $client->zipcode = Input::get('zipcode');
        $client->city = Input::get('city');
        $client->website = Input::get('website');
        $client->email = Input::get('email');
        $client->phone = Input::get('phone');
        $client->save();

        return Response::json($client);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Client::destroy($id);
		return Response::json(array('succes' => true));
	}


}
