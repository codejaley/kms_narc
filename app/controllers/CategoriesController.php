<?php

class CategoriesController extends \BaseController {
	
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin',array('except' => array('recursiveList')));
	}		
	
	/**
	 * Display a listing of categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$category_id = Input::has('parent_id') ? Input::get('parent_id') : 0;
		if($category_id == 0)
			$categories = Category::tree();
		else
			$categories = Category::filteredTree($category_id);		
		$list_categories =  array('0' => 'All') + DB::table('categories')->where('parent_id','=', 0)->lists('name','id');
		$this->layout->content = View::make('admin.categories.index', compact('categories','list_categories','category_id'));
	}

	/**
	 * Show the form for creating a new category
	 *
	 * @return Response
	 */
	public function create()
	{
		$publications = array('' => 'Select')+DB::table('publications')->orderBy('id', 'asc')->lists('name','id');
		$subjects = array('' => 'Select')+DB::table('subjects')->orderBy('id', 'asc')->lists('name','id');
		$categories = array('' => 'Select')+DB::table('categories')->orderBy('id', 'asc')->lists('name','id');
		$this->layout->content = View::make('admin.categories.create',compact('categories', 'publications', 'subjects'));
	}

	/**
	 * Store a newly created category in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messages = array(
			'name.required' 	=> 'Category Name is required',		
			'name.unique' 		=> 'Category Name already exists',
/*			'publication_id.required' 	=> 'Nature of publication is required',
			'subject_id.required' 	=> 'Subject is required',*/
			'photo.image' 		=> 'Please upload a valid image',

		);
		  
		$rules = array(
			'name' 	=> 'required|unique:categories,name',
/*			'publication_id' => 'required',
			'subject_id' 	=> 'required',*/
			'photo' 		=> 'image',
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);


		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (Input::file('photo') != '') {
			$destinationPath 	= public_path().'/category_covers/';
			$file 				= Input::file('photo');
			$filename 			= md5(time()).".".$file->getClientOriginalExtension();
			$data['photo']		= $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(300, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($destinationPath."cover_".$filename);
			unlink($destinationPath . $filename);
		} else {
			$data['photo'] = '';
		}

		$data['slug'] = Str::slug($data['name']);
		Category::create($data);

		return Redirect::route('admin.categories.index')->with('success_message','Category added sucessfully');
	}

	/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = Category::findOrFail($id);
		
		return View::make('categories.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::find($id);
		$publications = array('' => 'Select')+DB::table('publications')->orderBy('id', 'asc')->lists('name','id');
		$subjects = array('' => 'Select')+DB::table('subjects')->orderBy('id', 'asc')->lists('name','id');
		$categories = array('' => 'Select')+DB::table('categories')->orderBy('id', 'asc')->lists('name','id');
		$this->layout->content = View::make('admin.categories.edit', compact('category', 'categories', 'publications', 'subjects'));
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = Category::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Category::$rules);
		
		$messages = array(
			'name.required' 	=> 'Name is required',			
		  );
		  
		$rules = array(
			'name' 	=> 'required',
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);		

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$destinationPath 	= public_path().'/category_covers/';

		if(Input::file('photo')!=''){
			File::delete($destinationPath . $category->photo);
			File::delete($destinationPath . $category->image);
			if ($category->photo != ''){
				@unlink($destinationPath .'cover_' . $category->photo);
			}

			$file= Input::file('photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(300, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($destinationPath."cover_".$filename);
			unlink($destinationPath . $filename);
		}
		else{
			$filename 		= $category->photo;
			$data['photo']	= $filename;
		}

		$data['slug'] = Str::slug($data['name']);
		$category->update($data);

		return Redirect::route('admin.categories.index')->with('success_message','Category updated sucessfully');
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Category::destroy($id);

		return Redirect::route('categories.index');
	}
	//recursive list generation
	public function recursiveList()
	{
		$list_of_category = Category::tree()->toArray();	
		//print_r($list_of_category);
		//exit;
		$this->layout->content = View::make('admin.categories.recursive_list',compact('list_of_category'));
	}

	/* remove book photo */
	public function removePhoto($id){
		$category = Category::find($id);
		$destinationPath 	= public_path().'/category_covers/';
		if ($category->photo != '') {
			@unlink($destinationPath . 'cover_' . $category->photo);
		}
			Category::where('id', '=', $id)->update(array('photo' => ''));
		$redirect_path = 'admin/categories/' . $id . '/edit';
		return Redirect::to($redirect_path)->with('success_message','Book cover have been removed successfully.!');
	}

	/* delete user */
	public function delete($id) {

		$is_exists = Book::where('category_id', '=', $id)->count();
		if ($is_exists > 0){
			return Redirect::to('admin/categories')->with('error_message','Item is assosiated with this.');
		}
		$category = Category::find( $id );
		$category->delete();
		return Redirect::to('admin/categories')->with('success_message','Deleted sucessfully.');
	}

}
