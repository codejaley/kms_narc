<?php

class BooksController extends \BaseController {
	
	protected $layout = "admin.index";	
	
	
	public function __construct() {
  		$this->beforeFilter('auth.admin', array('except' => array('login', 'logout')));
    }		
    
    /**
    * Display a listing of books
    *
    * @return Response
    */
    public function index()
    {
    $category_id = Input::has('category_id') ? Input::get('category_id') : 0;
    $author_id  = Input::has('author_id') ? Input::get('author_id') : 0;
    
    $books = Book::orderBy('id','DESC')->with('OrmCategory')->get();
    if($author_id != 0) {
        $books = Book::orderBy('id','DESC')
						->whereIn('id',BookUser::where('user_id','=', $author_id)
						->lists('book_id'))->with('OrmCategory')->get();
        $category_id = 0;
    }
    if($category_id != 0) {
        $author_id = 0;
        $childs = Category::where('parent_id','=', $category_id)->lists('id');
        $child_array = array('5');
        foreach ($childs as $key => $value) {
            array_push($child_array, $value);
            $new_childs = Category::where('id','=', $value)->lists('id');
            foreach ($new_childs as $key1 => $value1) {
                $new_childs1 = Category::where('parent_id','=', $value1)->lists('id');
                foreach ($new_childs1 as $key2 => $value2) {
                    array_push($child_array, $value2);
                    }
                }
            }

        $books = Book::orderBy('id','DESC')
					->whereIn('category_id',$child_array)
					->with('OrmCategory')->get();
        }

        
    $authors = DB::table('users')->where('role_id','=', 2)->select('id',"firstname","lastname")->get();
    $list_authors = array('0' => "All");
    foreach($authors as  $key=>$value) {
        $list_authors[$value->id] = $value->firstname." ".$value->lastname;
    }
   //$queries = DB::getQueryLog();
    $list_categories =  array('0' => 'All') + DB::table('categories')->where('parent_id','=', 0)->lists('name','id');
    $this->layout->content = View::make('admin.books.index', compact('books','list_categories','list_authors','category_id','author_id'));
    }
    
    /**
    * Show the form for creating a new book
    *
    * @return Response
    */
    public function create()
    {
    $authors 	= DB::table('users')->where('role_id', '=', 4)->orderBy('firstname', 'asc')->lists('firstname','id');
    $categories = array('' => 'Select')+DB::table('categories')->orderBy('id', 'asc')->lists('name','id');
	$publishers  = DB::table('publishers')->where('is_active', '=', '1')->lists('name','id');
    $this->layout->content = View::make('admin.books.create',compact('categories', 'authors', 'publishers'));
    }
    
    /**
    * Store a newly created book in storage.
    *
    * @return Response
    */
    public function store()
    {
		$messages = array(
			'name.required' 			=> 'Item name is required',
			'category_id.required' 		=> 'Item Category is required',
			'photo.image' 				=> 'Please upload a valid image',
		);
		
		$rules = array(
			'name' 				=> 'required',
			'category_id'		=> 'required',
			'photo' 			=> 'image',

		);		
    
    
    $validator = Validator::make($data = Input::all(), $rules, $messages);
    
    if ($validator->fails())
    {
    return Redirect::back()->withErrors($validator)->withInput();
    }
    
	$item_status = (Auth::user()->role_id == 3)?'0' : '1';

		if (Input::file('photo') != '') {
			$destinationPath 	= public_path().'/covers/';
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

	// Str::slug($data['name']);
	$data['slug'] =str_replace(' ', '-', $data['name']);
    $data['is_active'] 	= $item_status;
    $data['user_id'] 	= Auth::user()->id;
    $Book = Book::create($data);

	if (isset($data['author_id'])) {
		foreach ($data['author_id'] as $user_id) {
			BookUser::create(array('user_id' => $user_id, 'book_id' => $Book->id));
		}
	}

    return Redirect::to('admin/books/manage_book/'. $Book->id .'?tab=2')->with('success_message','Item created sucessfully.');	
    }
    
    /**
    * Display the specified book.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    $book = Book::with('OrmCategory')->with('OrmUser')->findOrFail($id);
    
    $this->layout->content = View::make('admin.books.show', compact('book'));
    }
    
    /**
    * Show the form for editing the specified book.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
    $book = Book::find($id);
    
    $this->layout->content =  View::make('books.edit', compact('book'));
    }
    
    /**
    * Update the specified book in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
		$book = Book::findOrFail($id);
		
		$messages = array(
			'name.required' 			=> 'Book name is required',
			'category_id.required' 		=> 'Book Category is required',
			'photo.image' 		=> 'Please upload a valid image',
		);
		
		$rules = array(
			'name' 			=> 'required',
			'category_id'	=> 'required',
			'photo' 		=> 'image',

		);		
		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
		return Redirect::back()->withErrors($validator)->withInput();
		}
		
		DB::table('book_users')->where('book_id', '=', $id)->delete();		
		
		foreach($data['author_id'] as $author_id) {
			BookUser::create(array('book_id' => $id, 'user_id' => $author_id));
		}

		$destinationPath 	= public_path().'/covers/';

		if(Input::file('photo')!=''){
			File::delete($destinationPath . $book->photo);
			File::delete($destinationPath . $book->image);
			if ($book->photo != ''){
				@unlink($destinationPath .'cover_' . $book->photo);
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
			$filename 		= $book->photo;
			$data['photo']	= $filename;
		}

		$book->update($data);
		
		 return Redirect::to('admin/books/manage_book/'. $id .'?tab=1')->with('success_message','Item updated sucessfully.');	
    }
    
    /**
    * Remove the specified book from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
    Book::destroy($id);
    
    return Redirect::route('admin.books.index');
    }
    
    public function manageBook($book_id) {
		$categories = array('' => 'Select')+DB::table('categories')->orderBy('id', 'asc')->lists('name','id');
		$publishers = array('' => 'Select')+DB::table('publishers')->orderBy('id', 'asc')->lists('name','id');
		$documents  = Document::where('book_id', '=', $book_id)->get();
		$authors 	= DB::table('users')->where('role_id', '=', 4)->orderBy('firstname', 'asc')->lists('firstname','id');
		$selected_author = BookUser::where('book_id', '=', $book_id)->lists('user_id');
		$book = Book::find($book_id);
		
		$tags = BookTag::with('OrmTag')->where('book_id', '=', $book_id)->get();
		$arr_tags = array();
		foreach($tags as $tag) {
			$arr_tags[] = $tag->OrmTag->name;
		}		
		$tags = implode(",", $arr_tags);	
		
		if(Auth::user()->role_id == 3)
		{
			$this->layout->content = View::make('manage_books_user', compact('categories', 'documents', 'book', 'authors', 'selected_author','tags', 'publishers'));
		}
		$this->layout->content = View::make('admin.books.manage_book', compact('categories', 'documents', 'book', 'authors','selected_author', 'tags', 'publishers'));
    }
    
   	 public function uploadBookDocuments($book_id) {
		if (empty($_FILES) || $_FILES["file"]["error"]) {
			die('{"OK": 0}');
		}
    
		$destinationPath = public_path().'/dms_books/';
		//$destinationPath = '/home/ojhayogi/public_html/dms/dms_books' .'/dms_books/';
		$file 	  = Input::file('file');
		$filename = $file->getClientOriginalName() . '-' . date('U') . "." . $file->getClientOriginalExtension();
		$file->move($destinationPath, $filename);	
		
		$data['book_id']  = $book_id;
		$data['name'] 	  = $filename;
		Document::create($data);
		die('{"OK": 1}');			
    }	
    
    public function deleteBook($document_id) {
		$document = Document::where('id','=',$document_id)->get();	
		$destinationPath 	= public_path().'/dms_books/';

		foreach($document as $res)
		{
			File::delete($destinationPath . $res->name);
			$res->delete();
		}
		
		$book_tags = BookTag::where('book_id','=', $document[0]->book_id)->get();
		
		foreach ($book_tags as $key => $booktag) {
			$booktag->delete();
		}
	
		return Redirect::to('admin/books/manage_book/' . $document[0]->book_id . '?tab=2')->with('success_message','Document deleted sucessfully.');			
    }
    
    public function postMetaTags() {
		$book_id = Input::get('book_id');
		$tags = Input::get('tags');
		DB::table('book_tags')->where('book_id', '=', $book_id)->delete();
		if ($tags != '' ) {
			$tag_lists = explode(",", $tags);
			foreach($tag_lists as $tag) {
				if (strlen($tag) > 1) {
					$tag_exists = Tag::where('name', '=',$tag)->count();
					if ($tag_exists > 0) {
						$tag_data = Tag::where('name', '=',$tag)->select('id')->get();
						$data = array('book_id' => $book_id, 'tag_id' => $tag_data[0]->id);
						$book_tag_exists = BookTag::where('book_id', '=', $book_id)->where('tag_id', '=', $tag_data[0])->count();
						if ($book_tag_exists == 0 ) {
						BookTag::where('book_id', '=', $book_id)->where('tag_id', '=', $tag_data[0])->delete();
						BookTag::create($data);
					}
					} else {						
						$data = array('name' => $tag, 'slug' => Str::slug($tag));
						$tag = Tag::create($data);
						$data = array('book_id' => $book_id, 'tag_id' => $tag->id);
						$book_tag_exists = BookTag::where('book_id', '=', $book_id)->where('tag_id', '=', $tag->id)->count();
						if ($book_tag_exists == 0 ) {
							BookTag::where('book_id', '=', $book_id)->where('tag_id', '=', $tag->id)->delete();
							BookTag::create($data);						
						}
					}
				}
			}
			if(Auth::user()->role_id == 3){
				return Redirect::to('books/manage_book/'. $book_id .'?tab=3')->with('success_message','Tags have been added successfully.');	
			}
			return Redirect::to('admin/books/manage_book/'. $book_id .'?tab=3')->with('success_message','Tags have been added successfully.');	
		}
		return Redirect::back()->with('error_message','Please put valid tags');
    }
    
    public function listBooks($category_id) {
    $categories = array('' => 'Select')+DB::table('categories')->orderBy('id', 'asc')->lists('name','id');
    $books = Book::orderBy('id', 'DESC')->where('category_id', '=', $category_id)->paginate(20);	
    $query_strings = array_except( Input::query(), Paginator::getPageName());
    $this->layout->content = View::make('admin.books.book_lists', compact('books', 'query_strings', 'categories', 'category_id'));
    }
    
    public function changeStatus($status,$book_id)
    {
    $flag = ($status == 'd')?0 : 1;
    Book::where('id', '=', $book_id)->update(array('is_active' => $flag));
    return Redirect::route('admin.books.index')->with('success_message','Status changed sucessfully');	
    }
    
    //this gives show page for activate book
    public function verifyBooks()
    {
    if (Auth::user()->role_id != 1) {
    echo "You do not have permission to view this content!!";
    exit;
    }
    $books = Book::with('OrmCategory')->with('OrmUser')->where('is_active','=',0)->paginate(20);
    $query_strings = array_except( Input::query(), Paginator::getPageName());
    $this->layout->content = View::make('admin.books.verify_books',compact('books','query_strings'));
    }
    //show books category wise
    public function showBookCategoryWise($category_id)
    {
    $books = Book::where('category_id','=',$category_id)->get();
    $this->layout->content = View::make('admin.books.index', compact('books'));
    }
    
    //search book by its tag
    public function searchBookByTag($tag)
    {
    $tag = Tag::where('name','=',$tag)->get();
    if(count($tag) != 0){
    $book_tag = BookTag::where('tag_id','=',$tag[0]->id)->lists('id');
    if(count($book_tag) != 0)
    {
    $books  = Book::whereIn('id',$book_tag)->get();
    $this->layout->content = View::make('admin.books.index', compact('books'));
    }
    
    
    }
    return Redirect::to('/')->with('error_message','Please put valid tags');
    }
    
    public function showYourBooks() {
			$books = Book::with('OrmCategory')
							->where('user_id', '=',Auth::user()->id)
							->get();			
			$list_categories =  array('0' => 'All') + DB::table('categories')->where('parent_id','=', 0)->lists('name','id');
			$this->layout->content = View::make('admin.books.your_books',  compact('books','list_categories','category_id'));
    }
 	
	//delete main book
	public function deleteMainBook($book_id){		
		$document = Document::where('book_id','=',$book_id)->get();	
		$destinationPath 	= public_path().'/dms_books/';
		foreach($document as $res)
		{
			File::delete($destinationPath . $res->name);
			$res->delete();
		}
		$book_tags = BookTag::where('book_id','=', $book_id)->get();
		
		foreach ($book_tags as $key => $booktag) {
			$booktag->delete();
		}
		
		BookUser::where('book_id', '=',$book_id)->delete();
		Book::where('id', '=', $book_id)->delete();
		return Redirect::to('admin/books')->with('success_message','Book have been deleted successfully.');	
	}

	/* remove book photo */
	public function removeBookPhoto($id){
		$book = Book::find($id);
		$destinationPath 	= public_path().'/covers/';
		unlink($destinationPath . 'cover_' . $book->photo);
		Book::where('id', '=', $id)->update(array('photo' => ''));
		return Redirect::to('admin/books/manage_book/'. $id)->with('success_message','Book cover have been removed successfully.!');
	}

	/* return json */
	public function getJson(){
		return view('json');

	}

 } 


