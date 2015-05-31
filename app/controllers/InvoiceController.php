<?php

class InvoiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Invoice::with('client', 'project.tasklist.tasks')->get());
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
		$new_invoice = Invoice::create(array(
            'client_id' => Input::get('client_id'),
            'date' => Input::get('date'),
            'number' => Input::get('number'),
            'description' => Input::get('description'),
            'price_exc_btw' => Input::get('price_exc_btw'),
            'price_inc_btw' => Input::get('price_inc_btw'),
            'paid' => Input::get('paid'),
            'project_id' => Input::get('project_id')
        ));
    
        return Response::json(array('success' => true, 'last_insert_id' => $new_invoice->id));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice = Invoice::with('client', 'project.tasklist.tasks')->get()->find($id);
		return Response::json($invoice);
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
		$invoice = Invoice::find($id);
		$invoice->client_id = Input::get('client_id');
        $invoice->date = Input::get('date');
        $invoice->number = Input::get('number');
        $invoice->description = Input::get('description');
        $invoice->price_exc_btw = Input::get('price_exc_btw');
        $invoice->price_inc_btw = Input::get('price_inc_btw');
        $invoice->paid = Input::get('paid');
        $invoice->project_id = Input::get('project_id');
        $invoice->save();

        return Response::json($invoice);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Invoice::destroy($id);
		return Response::json(array('succes' => true));
	}


}
