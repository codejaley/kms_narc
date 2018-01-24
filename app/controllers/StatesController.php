<?php

class StatesController extends \BaseController {
	protected $layout = "admin.index";	

	public function __construct() {
		 $this->beforeFilter('auth.admin');
	}	

	/**
	 * Display a listing of states
	 *
	 * @return Response
	 */
	public function index()
	{
		$states = State::all();

		$this->layout->content= View::make('admin.states.index', compact('states'));
	}

	/**
	 * Show the form for creating a new state
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('states.create');
	}

	/**
	 * Store a newly created state in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), State::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		State::create($data);

		return Redirect::route('states.index');
	}

	/**
	 * Display the specified state.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$state = State::findOrFail($id);

		return View::make('states.show', compact('state'));
	}

	/**
	 * Show the form for editing the specified state.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$state = State::find($id);

		return View::make('states.edit', compact('state'));
	}

	/**
	 * Update the specified state in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$state = State::findOrFail($id);

		$validator = Validator::make($data = Input::all(), State::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$state->update($data);

		return Redirect::route('states.index');
	}

	/**
	 * Remove the specified state from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		State::destroy($id);

		return Redirect::route('states.index');
	}

}
