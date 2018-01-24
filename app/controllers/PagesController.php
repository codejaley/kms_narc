<?php

class PagesController extends \BaseController {
	
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin');
	}		
	
	/**
	 * Display a listing of pages
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::orderBy('id', 'DESC')->paginate(20);

		$this->layout->content = View::make('admin.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new page
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('admin.pages.create');
	}

	/**
	 * Store a newly created page in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messages = array(
			'title.required' 			=> 'Post title is required',
			'intro_text.required' 		=> 'Excerpt is required',
			'description.required' 		=> 'Description is required',
			'photo.image' 				=> 'Please upload a valid logo',						
		  );
		  
		$rules = array(
			'title' 					=> 'required',
			'intro_text' 				=> 'required',
			'description' 				=> 'required',
			'photo' 					=> 'image',
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if (Input::file('photo') != '') {
			$destinationPath 	= public_path().'/blog/';
			$file 				= Input::file('photo');
			$filename 			= md5(time()).".".$file->getClientOriginalExtension();
			$data['photo']		= $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);
			}
			$img = Image::make($destinationPath.$filename)->resize(303, 201);
			$img->save($destinationPath."th_".$filename);						
			unlink($destinationPath . $filename);	
		} else {
			$data['photo'] = '';
		}		
		$data['slug'] = Str::slug(Input::get('title'));
		Page::create($data);

		return Redirect::route('admin.pages.index')->with('success_message','Page added sucessfully');;
	}

	/**
	 * Display the specified page.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = Page::findOrFail($id);

		$this->layout->content = View::make('admin.pages.show', compact('page'));
	}
	
	/* show blog post details */
	public function showPage($id) {
		$page = Page::findOrFail($id);

		$this->layout->content = View::make('admin.pages.show', compact('page'));		
	}

	/**
	 * Show the form for editing the specified page.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = Page::find($id);

		$this->layout->content = View::make('admin.pages.edit', compact('page'));
	}

	/**
	 * Update the specified page in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = Page::findOrFail($id);
		$messages = array(
			'title.required' 			=> 'Post title is required',
			'intro_text.required' 		=> 'Excerpt is required',
			'description.required' 		=> 'Description is required',
			'photo.image' 				=> 'Please upload a valid logo',						
		  );
		  
		$rules = array(
			'title' 					=> 'required',
			'intro_text' 				=> 'required',
			'description' 				=> 'required',
			'photo' 					=> 'image',
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$destinationPath 	= public_path().'/blog/';
		if(Input::file('photo')!=''){
			File::delete($destinationPath . $page->logo);
			File::delete($destinationPath . $page->image);
			$file= Input::file('photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);	
			}
			$img = Image::make($destinationPath.$filename)->resize(303, 201);
			$img->save($destinationPath."th_".$filename);	
			unlink($destinationPath.$filename);	
		} else {
				$filename 		= $page->photo;
				$data['photo']	= $filename;
			}		
		
		$page->update($data);

		return Redirect::route('admin.pages.index')->with('success_message','Page updated sucessfully');
	}

	/**
	 * Remove the specified page from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Page::destroy($id);

		return Redirect::route('pages.index');
	}
	
	/* delete pages */
	public function delete($id) {		
		$page = Page::find( $id );
		$destinationPath 	= public_path().'/blog/';
		if ($page->photo != '') {
			File::delete($destinationPath . 'th_' . $page->photo);
		}	
		$page->delete();
		return Redirect::to('admin/pages')->with('success_message','Page deleted sucessfully.');			
	}	
	
	/* change status */
	public function changeStatus($status, $id) {
		$flag = ($status == 'd')?0 : 1;
		Page::where('id', '=', $id)->update(array('is_active' => $flag));
		return Redirect::route('admin.pages.index')->with('success_message','Status changed sucessfully');		
	}		

}
