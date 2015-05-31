<?php

class SettingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Setting::get());
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
		Setting::create(array(
            'name' => Input::get('name'),
            'adress' => Input::get('adress'),
            'zipcode' => Input::get('zipcode'),
            'city' => Input::get('city'),
            'website' => Input::get('website'),
            'email' => Input::get('email'),
            'phone' => Input::get('phone'),
            'kvk_nr' => Input::get('kvk_nr'),
            'btw_nr' => Input::get('btw_nr'),
            'iban' => Input::get('iban'),
            'bic_nr' => Input::get('bic_nr')
        ));
    
        return Response::json(array('success' => true));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function show($id)
	// {
	// 	$setting = Setting::find($id);
	// 	return Response::json($Setting);
	// }


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
		$setting = Setting::find($id);
		$setting->name = Input::get('name');
        $setting->adress = Input::get('adress');
        $setting->zipcode = Input::get('zipcode');
        $setting->city = Input::get('city');
        $setting->website = Input::get('website');
        $setting->email = Input::get('email');
        $setting->phone = Input::get('phone');
        $setting->kvk_nr = Input::get('kvk_nr');
        $setting->btw_nr = Input::get('btw_nr');
        $setting->iban = Input::get('iban');
        $setting->bic_nr = Input::get('bic_nr');

        $setting->save();

        return Response::json($setting);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function destroy($id)
	// {
	// 	Setting::destroy($id);
	// 	return Response::json(array('succes' => true));
	// }


}
