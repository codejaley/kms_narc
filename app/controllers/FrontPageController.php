<?php

class FrontPageController extends BaseController {
	
	protected $layout = "frontend.page-layout";
	
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
	
	/* show the static page content */
	public function showPageContent($slug)
	{
		
		$page = Page::where('slug', '=', $slug)->where('is_active', '=', '1')->get();		
		$this->layout->content = View::make('frontend.page', compact('page'));
	}
	
	/* shows the team page */
	public function showTeamPage() {
		$type = Input::get('type');
		if ($type) {
			$staff_type = ($type == 'staff')?1 : 2;
			$type_caption = 'Our Assosiates';
		} else {
			$staff_type = 1;
			$type_caption = 'Our Team';
		}
		$staffs = Staff::where('staff_type', '=', $staff_type)->orderBy('ordering', 'ASC')->where('is_active', '=', '1')->get();
		$this->layout->content = View::make('frontend.team', compact('staffs', 'type_caption'));
	}
	
	/* shows the oppurtunity */
	public function showOppurtunity() {
		 $type = Input::get('type');
			if ($type) {
				if ($type == 'consultant') {
					$slug = 'Consultant';
				} else if ($type == 'assosiation') {
					$slug = 'partnership';
				} else if($type == 'staff') {
					$slug = 'employment';
				}
				$vacancies = Vacancy::where('slug', '=', $type)->where('is_active', '=', '1')->orderBy('id', 'DESC')->get();
			} else {
				$slug = 'all';
				$vacancies = Vacancy::where('is_active', '=', '1')->orderBy('id', 'DESC')->get();				
			}		 
		 $query_strings = array_except( Input::query(), Paginator::getPageName());
		 $this->layout 			= View::make('frontend.general-layout');
		 $this->layout->content = View::make('frontend.oppurtunity_new', compact('vacancies', 'query_strings', 'slug'));
	}
	
	/* show oppurtunity details */
	public function showOppurtunityDetails($slug) {
		 $vacancy = Vacancy::where('sef', '=', $slug)->get();		 
		 $this->layout 			= View::make('frontend.general-layout');
		 $this->layout->content = View::make('frontend.vacancy-details', compact('vacancy'));
	}
	
	/* show the contact listing page */
	public function showContacts() {
		$contacts = Contact::where('is_active', '=', '1')->get();
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content = View::make('frontend.contact', compact('contacts'));		
	}
	
	/* show blog listings */
	public function showBlogPosts() {
		$blogs = Blog::where('is_active', '=', '1')->where('is_active', '=', 1)->orderBy('id', 'DESC')->paginate(10);
		$blogs_recent = Blog::where('is_active', '=', '1')->where('is_active', '=', 1)->orderByRaw("RAND()")->take(5)->get();
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.blogs', compact('blogs', 'blogs_recent'));				
	}
	
	/* show blog details */
	public function showBlogDetails($slug) {
		$blog = Blog::where('slug', '=', $slug)->get();
		$comments = Comment::where('blog_id', '=', $blog[0]->id)->where('is_active', '=', '1')->orderBy('id', 'DESC')->get();
		$latest_blogs = Blog::whereNotIn('id', array($blog[0]->id))->where('is_active', '=', 1)->orderBy('id', 'DESC')->take(5)->get();
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.blog_details', compact('blog', 'comments', 'latest_blogs'));			
	}
	
	/* submit the blog comment */
	public function submitBlogComment() {
		$blog_id = Input::get('blog_id');
		$blog = Blog::where('id', '=', $blog_id)->get();
		
		$messages = array(
			'name.required' 			=> 'Name is required',
			'email.required' 			=> 'Email is required',
			'comment.required' 			=> 'Comment is required',			
		  );
		  
		$rules = array(
			'name' 					=> 'required',
			'email' 					=> 'required',
			'comment' 					=> 'required',
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}		
		
		$data['blog_id'] = $blog_id;
		Comment::create($data);
		
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.blog_details', compact('blog', 'comments'));	
		return Redirect::back()->with('success_message','Comment posted sucessfully and is awaiting moderation.');	
	}
	
	/* lists projects */
	public function listProjects() {		
		
		$country_id = Input::get('country_id');
		$client_id 	= Input::get('client_id');
		$title	 	= Input::get('title');
		
		$project_obj =  DB::Table('projects')
						->join('project_countries', 'projects.id', '=', 'project_countries.project_id')
						->join('project_clients', 'projects.id', '=', 'project_clients.project_id');
						
		if ($country_id != '') {
			$project_obj->where('project_countries.country_id', '=', $country_id);
		}
		
		if ($client_id != '') {
			$project_obj->where('project_clients.client_id', '=', $client_id);
		}				
		
		if ($title != '') {
			$project_obj->where('projects.title', 'LIKE', "%$title%");
		}		
		
		if (Input::get('type')) {
			$type = Input::get('type');	
			if ($type == 'current') {			
				$project_obj->where('projects.end_date', '=', '');
				$project_obj->orderBy('projects.start_date', 'DESC');
				$project_caption = 'Current Projects';
			} else if($type == 'completed') {
				$project_obj->where('projects.end_date', '<', date('Y-m-d'));
				$project_obj->where('projects.end_date', '!=', '');
				$project_obj->orderBy('projects.start_date', 'DESC');
				$project_caption = 'Completed Projects';
			}		
		} else {
			$type = 'current';
			$project_obj->where('projects.end_date', '=', '');
			$project_obj->orderBy('projects.start_date', 'DESC');
			$project_caption = 'Current Projects';
		}
						
		$projects 				= $project_obj->groupBy('projects.id')
									->where('projects.is_active', '=', '1')
									->paginate(10);							
		
		
		$country_lists 			= array('' => 'Country') + DB::table('countries')->orderBy('name', 'asc')->lists('name','id');
		$client_lists  			= array('' => 'Client') + DB::table('clients')->orderBy('id', 'asc')->lists('name','id');		
		$query_strings 			= array_except( Input::query(), Paginator::getPageName());
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.project_listings', compact('projects', 'country_lists', 'client_lists', 'type', 'query_strings','project_caption'));				
	}
	
	/* show the front end map */
	public function showMap() {
		$contact_countries  = $this->getOfficeCountry();
		$all_countries 		= $this->getAllCountries();
		$worked_countries 	= $this->getAllCountriesColorCodes();			
		$settings_maps_page_text = Setting::where('key', '=', 'project_page_text')->get();
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.maps', compact('all_countries', 'worked_countries', 'settings_maps_page_text', 'contact_countries'));						
	}
	
	/* lists the country with office */
	public function getOfficeCountry() {
		$countries = Contact::with('OrmCountry')->get();
		foreach($countries as $country) {
			$data[] =  strtolower($country->OrmCountry->code) . ":'#02007a'";
		}
		$countries = implode(",", $data);	
		return $countries;
	}
	
	/* lists all countries */
	public function getAllCountries() {
		$all_country_codes 		= ProjectCountry::with('OrmCountry')->get();
		foreach($all_country_codes as $all_country_code) {
			$data[] =  '"' . strtolower($all_country_code->OrmCountry->code) . '"';
		}
		$all_countries = implode(",", $data);	
		return $all_countries;		
	}
	
	/* get all worked countries color code */
	public function getAllCountriesColorCodes() {
		$all_country_codes 		= ProjectCountry::with('OrmCountry')->get();
		foreach($all_country_codes as $all_country_code) {
			$data[] =  strtolower($all_country_code->OrmCountry->code) . ":'#32d134'";
		}	
		$countries = implode(",", $data);	
		return $countries;
	}
	
	/* lists the current countries */
	public function getCurrentCountries() {
		$past_countries = Project::with('OrmProjectCountry')->where('end_date', '=', '')->select('id', 'title')->get();
		foreach($past_countries as $past_country) {
			$past_lists[] = $past_country->OrmProjectCountry[0]->country_id;
		}	
		$past_country_lists = array_unique($past_lists);
		foreach($past_country_lists as $country_id) {
			$country = Country::find($country_id);
			$data[] = strtolower($country->code) . ":'#0000ff'";
		}
		$countries = implode(",", $data);
		return $countries;
	}
	
	/* lists the past countries */
	public function getPastCountries() {
		$past_countries = Project::with('OrmProjectCountry')->where('end_date', '<', date('m/d/Y'))->select('id', 'title')->get();
		foreach($past_countries as $past_country) {
			$past_lists[] = $past_country->OrmProjectCountry[0]->country_id;
		}	
		$past_country_lists = array_unique($past_lists);
		foreach($past_country_lists as $country_id) {
			$country = Country::find($country_id);
			$data[] = strtolower($country->code) . ":'#ff0000'";
		}
		$countries = implode(",", $data);
		return $countries;
	}
	
	/* shows the projects as per the passed country code */
	public function showMapProjects($code) {
		$country = Country::where('code', '=', $code)->get();
		$projects = DB::table('projects')
					->join('project_countries', 'projects.id', '=', 'project_countries.project_id')
					->where('project_countries.country_id','=', $country[0]->id)
					->select('projects.id', 'projects.title', 'projects.description')
					->orderBy('projects.start_date','ASC')
					->get();												
		$this->layout 			= View::make('frontend.maps_layout');
		$this->layout->content 	= View::make('frontend.map_project_listings', compact('country', 'projects'));	
	}	
	
	/* lists the albums */
	public function showAlbums() {
		$albums = Album::orderBY('id','DESC')->where('is_active','=','1')->with('OrmCoverAlbum')->paginate(10);
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.albums',compact('albums'));				
	}
	
	/* show photos inside the album */
	public function showAlbumsPhotos($slug) {
		$album = Album::where('slug', '=', $slug)->get();
		$photos = Photo::where('album_id', '=', $album[0]->id)->get();
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.photos',compact('photos', 'album'));					
	}
	
	/* show project details */
	public function showProjectDetails($id) {
		$project 			= Project::with('OrmClient')->where('id', '=', $id)->get();		
		$other_projects 	= Project::orderBy('id', 'DESC')->where('end_date', '=', '')->where('id', '!=', $id)->take(5)->get();	
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.project_details',compact('project', 'other_projects'));				
	}
	
	/* show client page */
	public function showClientPage() {
		$setting_text 	= Setting::where('key', '=', 'client_text')->get();
		$clients = Client::orderBy('ordering', 'ASC')->paginate(12);
		$settings_image = Setting::where('key', '=', 'client_logo')->get();				
		$this->layout->content 	= View::make('frontend.client_page',compact('setting_text', 'settings_image', 'clients'));			
	}
	
	/* show service page */
	public function showServicePage() {
		$service_intro_text 		= Setting::where('key', '=', 'service_intro_text')->get();
		$service_sidebar_text 		= Setting::where('key', '=', 'service_sidebar_text')->get();
		$service_client_quote 		= Setting::where('key', '=', 'service_client_quote')->get();
		$service_page_photo 		= Setting::where('key', '=', 'service_page_photo')->get();			
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.our-services',compact('service_intro_text', 'service_sidebar_text', 'service_page_photo', 'service_client_quote'));
	}
	
	/* show ivc page */
	public function showIvcPage() {
		$ivc_intro_text 		= Setting::where('key', '=', 'ivc_intro_text')->get();
		$ivc_client_text 		= Setting::where('key', '=', 'ivc_client_text')->get();
		$ivc_photo 				= Setting::where('key', '=', 'ivc_photo')->get();	
		$ivc_photo_caption 		= Setting::where('key', '=', 'ivc_photo_caption')->get();	
		$ivc_photo_content 		= Setting::where('key', '=', 'ivc_photo_content')->get();	
		$ivc_table_content 		= Setting::where('key', '=', 'ivc_table_content')->get();			
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.ivc', compact('ivc_intro_text', 'ivc_client_text', 'ivc_photo', 'ivc_photo_caption', 'ivc_photo_content', 'ivc_table_content'));
	}
	
	public function showCompanyPage() {
		$ivc_intro_text 		= Setting::where('key', '=', 'company_intro_text')->get();
		$ivc_client_text 		= Setting::where('key', '=', 'company_client_text')->get();
		$ivc_photo 				= Setting::where('key', '=', 'company_photo')->get();	
		$ivc_photo_caption 		= Setting::where('key', '=', 'company_photo_caption')->get();	
		$ivc_photo_content 		= Setting::where('key', '=', 'company_photo_content')->get();	
		$ivc_table_content 		= Setting::where('key', '=', 'company_table_content')->get();			
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.company', compact('ivc_intro_text', 'ivc_client_text', 'ivc_photo', 'ivc_table_content'));
	}
	
	public function showFoodPage() {
		$ivc_intro_text 		= Setting::where('key', '=', 'food_intro_text')->get();
		$ivc_client_text 		= Setting::where('key', '=', 'food_client_text')->get();
		$ivc_photo 				= Setting::where('key', '=', 'food_photo')->get();	
		$ivc_photo_caption 		= Setting::where('key', '=', 'food_photo_caption')->get();	
		$ivc_photo_content 		= Setting::where('key', '=', 'food_photo_content')->get();	
		$ivc_table_content 		= Setting::where('key', '=', 'food_table_content')->get();			
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.food', compact('ivc_intro_text', 'ivc_client_text', 'ivc_photo', 'ivc_table_content'));
	}
	
	public function showClimatePage() {
		$ivc_intro_text 		= Setting::where('key', '=', 'climate_intro_text')->get();
		$ivc_client_text 		= Setting::where('key', '=', 'climate_client_text')->get();
		$ivc_photo 				= Setting::where('key', '=', 'climate_photo')->get();	
		$ivc_photo_caption 		= Setting::where('key', '=', 'climate_photo_caption')->get();	
		$ivc_photo_content 		= Setting::where('key', '=', 'climate_photo_content')->get();	
		$ivc_table_content 		= Setting::where('key', '=', 'climate_table_content')->get();			
		$this->layout 			= View::make('frontend.general-layout');
		$this->layout->content 	= View::make('frontend.climate', compact('ivc_intro_text', 'ivc_client_text', 'ivc_photo', 'ivc_table_content'));
	}		
	
	/* submit contact form */
	public function submitContactForm() {
		$messages = array(
			'firstname.required' 		=> 'First Name is required',
			'email.required' 			=> 'Email is required',
			'comment.required' 			=> 'Comment is required',			
		  );
		  
		$rules = array(
			'firstname' 				=> 'required',
			'email' 					=> 'required',
			'comment' 					=> 'required',
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}	
		
			Mail::send('emails.contact.template', array('firstname'	=> Input::get('firstname'), 
											'lastname'			=> Input::get('lastname'), 
											'phone'				=> Input::get('phone'), 
											'email'				=> Input::get('email'), 	
											'comment' 			=> Input::get('comment')), function($message){
				$message->to(Config::get('front-constants.CONTACT_EMAIL'))->subject(Config::get('front-constants.CONTACT_EMAIL_TITLE'));
		});	
		
		return Redirect::back()->with('success_message', 'Form submitted sucessfully!!');	
	}		
}
