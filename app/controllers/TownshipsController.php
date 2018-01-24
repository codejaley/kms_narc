<?php

class TownshipsController extends \BaseController {

	/**
	 * Display a listing of townships
	 *
	 * @return Response
	 */
	public function index()
	{
		$townships = Township::all();

		return View::make('townships.index', compact('townships'));
	}

	/**
	 * Show the form for creating a new township
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('townships.create');
	}

	/**
	 * Store a newly created township in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Township::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Township::create($data);

		return Redirect::route('townships.index');
	}

	/**
	 * Display the specified township.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$township = Township::findOrFail($id);

		return View::make('townships.show', compact('township'));
	}

	/**
	 * Show the form for editing the specified township.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$township = Township::find($id);

		return View::make('townships.edit', compact('township'));
	}

	/**
	 * Update the specified township in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$township = Township::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Township::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$township->update($data);

		return Redirect::route('townships.index');
	}

	/**
	 * Remove the specified township from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Township::destroy($id);

		return Redirect::route('townships.index');
	}

}
