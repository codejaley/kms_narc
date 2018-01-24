<?php

class PublicationsController extends \BaseController {

	protected $layout = "admin.index";


	public function __construct() {
		$this->beforeFilter('auth.admin', array('except' => array('login', 'logout')));
	}

	/**
	 * Display a listing of publications
	 *
	 * @return Response
	 */
	public function index()
	{
		$publications = Publication::orderBy('name', 'ASC')->get();

		$this->layout->content = View::make('admin.publications.index', compact('publications'));
	}

	/**
	 * Show the form for creating a new publication
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('admin.publications.create');
	}

	/**
	 * Store a newly created publication in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messages = array(
			'name.required' 	=> 'Name is required',
			'name.unique' 		=> 'Name already exists',

		);

		$rules = array(
			'name' 	=> 'required|unique:publications,name',
		);

		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Publication::create($data);

		return Redirect::route('admin.publications.index');
	}

	/**
	 * Display the specified publication.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$publication = Publication::findOrFail($id);

		return View::make('publications.show', compact('publication'));
	}

	/**
	 * Show the form for editing the specified publication.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$publication = Publication::find($id);

		$this->layout->content = View::make('admin.publications.edit', compact('publication'));
	}

	/**
	 * Update the specified publication in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$publication = Publication::findOrFail($id);

		$messages = array(
			'name.required' 	=> 'Name is required',
			'name.unique' 		=> 'Name already exists',

		);

		$rules = array(
			'name' 	=> 'required',
		);

		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$publication->update($data);

		return Redirect::route('admin.publications.index');
	}

	/**
	 * Remove the specified publication from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Publication::destroy($id);

		return Redirect::route('publications.index');
	}

	/* change user status */
	public function changeStatus($status, $id) {
		$flag = ($status == 'd')?0 : 1;
		Publication::where('id', '=', $id)->update(array('is_active' => $flag));
		return Redirect::route('admin.publications.index')->with('success_message','Status changed sucessfully');
	}

	/* delete user */
	public function delete($id) {

		$is_exists = Category::where('publication_id', '=', $id)->count();
		if ($is_exists > 0){
			return Redirect::to('admin/publications')->with('error_message','Category is assosiated with this.');
		}
		$publication = Publication::find( $id );
		$publication->delete();
		return Redirect::to('admin/publications')->with('success_message','Deleted sucessfully.');
	}

}
