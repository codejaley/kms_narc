<?php

class HomeController extends BaseController {
	
	protected $layout = "frontend.home-layout";
	
	private $page_title = 'ss';
	
	public function __construct() {
			$title = ($this->page_title == '')?'Sample' : $this->page_title;
			View::share("page_title", $title);
			if(Auth::check()) {		
				if (Auth::user()->id == '') {
					return Redirect::to('/');
				}
			} else {
				if (Route::getCurrentRoute()->getPath() != '/') {
					Redirect::to('/')->send();
				}
			}			
    }		
	
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showHomePage()
	{
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$query = "SELECT 
					users.id,
					users.firstname,
					count(book_users.id) as total_books
					FROM 
						users 
					LEFT JOIN book_users On(users.id=book_users.user_id)
					LEFT JOIN books ON(book_users.book_id=books.id)
					WHERE 1=1
						AND users.role_id='4'
					GROUP BY 
						users.firstname
					HAVING total_books > 0	
					ORDER BY 
						total_books DESC
					LIMIT 0,10";
		$authors =  DB::select(DB::raw($query));		
		$categories = Category::orderBy('name', 'ASC')->where('parent_id', '=', 0)->where('is_active', '=',1)->paginate(50);
		$this->layout->content = View::make('frontend.home', compact('categories', 'authors'));
	}
	
	public function listsChildCategories($slug) {
		$this->page_title = "NARC :: Knowledgebase Managament System";		
		$category   = Category::where('slug', '=',$slug)->get();
		$categories = Category::tree_child($category[0]->id)->toArray();
		$books = Book::with('OrmCategory')
					->where('category_id', '=', $category[0]->id)
					->where('is_active', '=', 1)
					->orderBy('name', 'ASC')
					->get();					
		$this->layout->content = View::make('frontend.browse_categories', compact('category','categories', 'books'));		
	}
	
	public function listsBooksByCategory($slug) {
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$category = Category::where('slug', '=', $slug)->get();
		$books = Book::with('OrmCategory')
					->where('category_id', '=', $category[0]->id)
					->where('is_active', '=', 1)
					->orderBy('name', 'ASC')
					->get();
		$this->layout->content = View::make('frontend.book_lists', compact('books', 'category'));
	}
	
	public function listsBooksByDate() {
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$items = Book::with('OrmCategory')->where('is_active', '=',1)->orderBy('published_date', 'DESC')->get();
		$this->layout->content = View::make('frontend.book_lists_date',compact('items'));
	}
	
	public function showBookDetails($slug) {
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$book    = Book::with('OrmPublisher')->where('slug', '=', $slug)->get();
		$books 	 = Book::with('OrmDocument')->where('id','=',$book[0]->id)->where('is_active', '=', 1)->get();	
		$total_document = Document::where('book_id', '=', $book[0]->id)->count();
		$authors = BookUser::with('OrmUser')->where('book_id', '=',$book[0]->id)->get(); 		
		$this->layout->content = View::make('frontend.book_details', compact('books', 'authors', 'book', 'total_document'));
	}
	
	public function handleSearchText() {
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$search_value = Input::get('search_box');
		return Redirect::to('search/result/'. $search_value);
	}
	
	/* main search query */
	public function showSearchResult($search) {
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$search_key = urldecode($search);
		$query = "SELECT
						books.id,
						books.photo,
						books.date_format,
						books.name,
						books.slug,
						books.published_date,
						categories.name as category
					FROM books
					LEFT JOIN book_tags ON(books.id=book_tags.book_id)
					LEFT JOIN tags ON(book_tags.tag_id=tags.id)
					LEFT JOIN documents ON(books.id=documents.book_id)
					INNER JOIN categories ON(books.category_id = categories.id)
					WHERE 1=1
						AND tags.name LIKE '%". $search_key ."%'
						OR books.name LIKE '%". $search_key ."%'
						OR books.description LIKE '%". $search_key ."%'
						OR documents.title LIKE '%". $search_key ."%'					
						GROUP BY books.id";
		$results = DB::select(DB::raw($query));						
		$this->layout->content = View::make('frontend.search_results', compact('search_key', 'results'));
	}

	/* show publication items */
	public function showPublicationBooks($id){
		$results = Category::orderBy('name', 'ASC')->where('publication_id', '=', $id)->get();
		$publication = Publication::find($id);
		$this->layout->content = View::make('frontend.publication_items', compact('results', 'publication'));
	}

	/* show publication items */
	public function showSubjectBooks($id){
		$results = Category::orderBy('name', 'ASC')->where('subject_id', '=', $id)->get();
		$subject = Subject::find($id);
		$this->layout->content = View::make('frontend.subject_items', compact('results', 'subject'));
	}

	public function showAdvanceSearchResult() {
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$selected_cat = (Input::get('parent'))? Input::get('parent') : '';
		$categories = array('' => 'Select')+DB::table('categories')
											->where('parent_id', '=', 0)
											->orderBy('name', 'asc')
											->lists('name','id');		
		if ($selected_cat != '') {
			$child_cats = Category::tree_child($selected_cat)->toArray();
			$cat_id_array	= array();
			$cat_name_array = array();	
			
			foreach($child_cats as $cat) {
				$cat_id_array[] 	=  $cat['id'];
				$cat_name_array[] 	=  $cat['name'];
				if (count($cat['children']) > 0) {
						foreach($cat['children'] as $category) {
							$cat_name_array[] 	=  $category['name'];
							$cat_id_array[] 	=  $category['id'];
						}
				}
			}
			$child_lists = array_combine($cat_id_array, $cat_name_array);			
		} else {
			$child_lists = array('');
		}
		
		$author_lists = DB::table('users')
						->where('role_id', '=', 4)
						->where('is_active', '=', 1)
						->orderBy('firstname', 'asc')
						->lists('firstname','id');
								
		$this->layout->content = View::make('frontend.advanced_search',compact('categories', 'selected_cat', 'child_lists', 'author_lists'));
	}
	
	public function showAuthorLists() {		
		$this->page_title = "NARC :: Knowledgebase Managament System";
		$alphabets = array('A', 'B', 'C', 'D', 'E', 'F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		if (Input::get('char')) {
			$where_condition = " users.firstname LIKE '". Input::get('char') . "%' AND users.is_active='1' AND users.role_id='4'";
		} else {
			$where_condition = " users.is_active='1' AND users.role_id='4'";
		}		
		
		$query = "SELECT 
					users.id as user_id,
					users.firstname,
					users.lastname,
					count(book_users.id) as total_books
				FROM 
					users 
				LEFT JOIN book_users On(users.id=book_users.user_id)
				LEFT JOIN books ON(book_users.book_id=books.id)
				WHERE ". $where_condition ."
				GROUP BY 
					users.firstname
				ORDER BY 
					total_books DESC";
		$authors = DB::select(DB::raw($query));			
			
		$this->layout->content = View::make('frontend.author_lists',compact('alphabets', 'authors'));
	}
	
	public function listsAuthorItems($author_id) {
		$this->page_title = "NARC :: Knowledgebase Managament System";			
		$author = User::where('id', '=',$author_id)->get(); 		
		$books = BookUser::with('OrmBook')->with('OrmUser')->where('user_id', '=', $author_id)->get();						
		$this->layout->content = View::make('frontend.author_item_lists', compact('books', 'author'));
	}
	
	/* lists all the parent categories */
	public function listsAllCategories() {
		$categories = Category::where('parent_id', '=', 0)->where('is_active', '=', 1)->get();
		$this->layout->content = View::make('frontend.parent_category_lists', compact('categories'));
	}

	/* lists all publications in home page */
	public function listsAllPublications() {
		$publications = Publication::where('is_active', '=', '1')->get();
		$this->layout->content = View::make('frontend.publications', compact('publications'));
	}

	/* lists all publications in home page */
	public function listsAllSubjects() {
		$subjects = Subject::where('is_active', '=', '1')->get();
		$this->layout->content = View::make('frontend.subjects', compact('subjects'));
	}

	/* build advance search url */
	public function buildAdvanceSearchUrl() {			
		if (sizeof(Input::get('authors')) > 0) {
			$author_lists = implode(",", Input::get('authors'));		
		} else {
			$author_lists = '';	
		}
			
		if (sizeof(Input::get('cat_ids')) > 0) {			
			$cat_to_search = implode(",", Input::get('cat_ids'));
		} else {
			if (Input::get('parent_id')) {
				$cat_to_search = Input::get('parent_id');
			} else {
				$cat_to_search = '';
			}
		}
		
		return Redirect::to('adv-search/result/?cats='. $cat_to_search . '&key=' . Input::get('search_keyword'). '&authors=' . $author_lists);
	}	
	
	/* advance search result */
	public function listsAdvanceSearchUrl() {
		$search_key = 	Input::get('key');
		
		if (Input::get('cats') != '') {
			$cats_sql = " AND categories.id IN(". Input::get('cats') .")";
		} else {
			if (Input::get('parent_id')) {
				$cats_sql = ' AND ';
			} else {
				$cats_sql = " AND categories.id IN(". Input::get('parent_id') .")";
			}
		}
		
		if ($search_key != '') {
			$text_search = 	" AND tags.name LIKE '%". $search_key ."%'
							OR books.name LIKE '%". $search_key ."%'
							OR books.description LIKE '%". $search_key ."%'
							OR documents.title LIKE '%". $search_key ."%'";	
		} else {
			$text_search = '';
		}
		
		if (Input::get('authors') != '') {
			$author_sql = " AND book_users.user_id IN(". Input::get('authors') .")";
		} else {
			$author_sql = '';
		}
		
		$query = "SELECT
						books.id,
						books.name,
						books.slug,
						books.published_date,
						categories.name as category
					FROM books
					LEFT JOIN book_tags ON(books.id=book_tags.book_id)
					LEFT JOIN tags ON(book_tags.tag_id=tags.id)
					LEFT JOIN documents ON(books.id=documents.book_id)
					LEFT JOIN book_users ON(book_users.book_id=books.id)
					INNER JOIN categories ON(books.category_id = categories.id)
					WHERE 1=1
						".$cats_sql
						 .$text_search		
						 .$author_sql	
						 ." GROUP BY books.id";

		$results = DB::select(DB::raw($query));				
		$this->layout->content = View::make('frontend.adv-search_results', compact('results'));
	}
	
	/* show the static page content */
	public function showPageContent($slug)
	{		
		$page = Page::where('slug', '=', $slug)->where('is_active', '=', '1')->get();		
		$this->layout->content = View::make('frontend.page', compact('page'));
	}


	/* return json */
	public function getJson(){
		 $book = Book::orderBy('id','DESC')->with('OrmCategory')->get();
		 $book = json_encode(array('data' => $book));
		 

		
		 return $book;
	}	
	
}
