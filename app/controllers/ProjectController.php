<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Project::with('category', 'client', 'tasklist.tasks', 'invoice')->get());
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
		Project::create(array(
            'description' => Input::get('description'),			
            'price_method' => Input::get('price_method'),
            'sales_tax' => Input::get('sales_tax'),
            'price' => Input::get('price'),
            'total_price' => Input::get('total_price'),
            'delivery_date' => Input::get('delivery_date'),
            'finished' => Input::get('finished'),
            'category_id' => Input::get('category_id'),
            'client_id' => Input::get('client_id'),
            'invoice_id' => Input::get('invoice_id'),
            'tasklist_id' => Input::get('tasklist_id')
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
		$project = Project::with('category', 'client', 'tasklist.tasks', 'invoice')->get()->find($id);
		return Response::json($project);
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
		$project = Project::find($id);
		$project->description = Input::get('description');
        $project->price_method = Input::get('price_method');
        $project->sales_tax = Input::get('sales_tax');
        $project->price = Input::get('price');
        $project->total_price = Input::get('total_price');
        $project->delivery_date = Input::get('delivery_date');
        $project->finished = Input::get('finished');
        $project->category_id = Input::get('category_id');
        $project->client_id = Input::get('client_id');
        $project->invoice_id = Input::get('invoice_id');
        $project->tasklist_id = Input::get('tasklist_id');
        $project->save();

        return Response::json($project::with('category', 'client', 'tasklist.tasks', 'invoice')->get()->find($id));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Project::destroy($id);
		return Response::json(array('succes' => true));
	}


}
