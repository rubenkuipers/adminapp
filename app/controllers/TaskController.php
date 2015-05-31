<?php

class TaskController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Task::get());
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
		Task::create(array(
			'tasklist_id' => Input::get('tasklist_id'),
            'date' => Input::get('date'),
            'description' => Input::get('description'),
            'hours' => Input::get('hours'),
            'price_exc_btw' => Input::get('price_exc_btw'),
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
		$task = Task::find($id);
		return Response::json($task);
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
		$task = Task::find($id);
		$task->tasklist_id = Input::get('tasklist_id');
		$task->date = Input::get('date');
		$task->description = Input::get('description');
		$task->hours = Input::get('hours');
		$task->price_exc_btw = Input::get('price_exc_btw');
        $task->save();

        return Response::json($task);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Task::destroy($id);
		return Response::json(array('succes' => true));
	}


}
