<?php

class PublishersController extends \BaseController {

	protected $layout = "admin.index";

	public function __construct() {
		$this->beforeFilter('auth.admin');
	}

	/**
	 * Display a listing of publishers
	 *
	 * @return Response
	 */
	public function index()
	{
		$publishers = Publisher::orderBy('name', 'ASC')->get();

		$this->layout->content = View::make('admin.publishers.index', compact('publishers'));
	}

	/**
	 * Show the form for creating a new publisher
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('admin.publishers.create');
	}

	/**
	 * Store a newly created publisher in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messages = array(
			'name.required' 			=> 'Name is required',
		);

		$rules = array(
			'name' 				=> 'required',

		);

		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Publisher::create($data);

		return Redirect::route('admin.publishers.index');
	}

	/**
	 * Display the specified publisher.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$publisher = Publisher::findOrFail($id);

		return View::make('publishers.show', compact('publisher'));
	}

	/**
	 * Show the form for editing the specified publisher.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$publisher = Publisher::find($id);

		$this->layout->content = View::make('admin.publishers.edit', compact('publisher'));
	}

	/**
	 * Update the specified publisher in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$publisher = Publisher::find($id);
		$messages = array(
			'name.required' 			=> 'Name is required',
		);

		$rules = array(
			'name' 				=> 'required',

		);

		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$publisher->update($data);

		return Redirect::route('admin.publishers.index');
	}

	/**
	 * Remove the specified publisher from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Publisher::destroy($id);

		return Redirect::route('publishers.index');
	}

	public function changeStatus($status,$id)
	{
		$flag = ($status == 'd')?0 : 1;
		Publisher::where('id', '=', $id)->update(array('is_active' => $flag));
		return Redirect::route('admin.publishers.index')->with('success_message','Status changed sucessfully');
	}

	/* delete user */
	public function delete($id) {

		$is_exists = Book::where('publisher_id', '=', $id)->count();
		if ($is_exists > 0){
			return Redirect::to('admin/publishers')->with('error_message','Item is assosiated with this.');
		}
		$publisher = Publisher::find( $id );
		$publisher->delete();
		return Redirect::to('admin/publishers')->with('success_message','Publication deleted sucessfully.');
	}

}
