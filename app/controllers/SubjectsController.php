<?php

class SubjectsController extends \BaseController {

	protected $layout = "admin.index";


	public function __construct() {
		$this->beforeFilter('auth.admin', array('except' => array('login', 'logout')));
	}

	/**
	 * Display a listing of subjects
	 *
	 * @return Response
	 */
	public function index()
	{
		$subjects = Subject::orderBy('name', 'ASC')->get();

		$this->layout->content = View::make('admin.subjects.index', compact('subjects'));
	}

	/**
	 * Show the form for creating a new subject
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('admin.subjects.create');
	}

	/**
	 * Store a newly created subject in storage.
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
			'name' 	=> 'required|unique:subjects,name',
		);

		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Subject::create($data);

		return Redirect::route('admin.subjects.index');
	}

	/**
	 * Display the specified subject.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$subject = Subject::findOrFail($id);

		return View::make('subjects.show', compact('subject'));
	}

	/**
	 * Show the form for editing the specified subject.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$subject = Subject::find($id);

		$this->layout->content = View::make('admin.subjects.edit', compact('subject'));
	}

	/**
	 * Update the specified subject in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$subject = Subject::findOrFail($id);

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

		$subject->update($data);

		return Redirect::route('admin.subjects.index');
	}

	/**
	 * Remove the specified subject from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Subject::destroy($id);

		return Redirect::route('subjects.index');
	}

	/* change user status */
	public function changeStatus($status, $id) {
		$flag = ($status == 'd')?0 : 1;
		Subject::where('id', '=', $id)->update(array('is_active' => $flag));
		return Redirect::route('admin.subjects.index')->with('success_message','Status changed sucessfully');
	}
	

	/* delete user */
	public function delete($id) {

		$is_exists = Category::where('subject_id', '=', $id)->count();
		if ($is_exists > 0){
			return Redirect::to('admin/subjects')->with('error_message','Category is assosiated with this.');
		}
		$subject = Subject::find( $id );
		$subject->delete();
		return Redirect::to('admin/subjects')->with('success_message','Subject deleted sucessfully.');
	}

}
