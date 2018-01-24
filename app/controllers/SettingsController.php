<?php

class SettingsController extends \BaseController {
	
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin');
	}		
	
	/**
	 * Display a listing of settings
	 *
	 * @return Response
	 */
	public function index()
	{
		$constants				 = Constant::orderBy('ordering', 'ASC')->orderBy('id', 'DESC')->get();
		$this->layout->content 	 = View::make('admin.settings.index', compact('constants'));
	}

	/**
	 * Show the form for creating a new setting
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('settings.create');
	}

	/**
	 * Store a newly created setting in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Setting::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Setting::create($data);

		return Redirect::route('settings.index');
	}

	/**
	 * Display the specified setting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$setting = Setting::findOrFail($id);

		return View::make('settings.show', compact('setting'));
	}

	/**
	 * Show the form for editing the specified setting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$setting = Setting::find($id);

		return View::make('settings.edit', compact('setting'));
	}

	/**
	 * Update the specified setting in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$setting = Setting::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Setting::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$setting->update($data);

		return Redirect::route('settings.index');
	}

	/**
	 * Remove the specified setting from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Setting::destroy($id);

		return Redirect::route('settings.index');
	}
	
	/* update all the settings */
	public function updateSettings() {
		$data = Input::all();
		
		if ($data['footer_copyright_text'] != '') {
			Setting::where('key', '=', 'footer_copyright_text')->update(array('value' => $data['footer_copyright_text']));	
		}
		
		if ($data['facebook_link'] != '') {
			Setting::where('key', '=', 'facebook_link')->update(array('value' => $data['facebook_link']));	
		}	
		
		if ($data['twitter_link'] != '') {
			Setting::where('key', '=', 'twitter_link')->update(array('value' => $data['twitter_link']));	
		}	
		
		if ($data['youtube_link'] != '') {
			Setting::where('key', '=', 'youtube_link')->update(array('value' => $data['youtube_link']));	
		}
		
		if ($data['linkedin_link'] != '') {
			Setting::where('key', '=', 'linkedin_link')->update(array('value' => $data['linkedin_link']));	
		}			
		
		if ($data['home_page_slogan'] != '') {
			Setting::where('key', '=', 'home_page_slogan')->update(array('value' => $data['home_page_slogan']));	
		}													
		
		return Redirect::to('admin/settings')->with('success_message','Settings updated sucessfully');
	}
	
	/* shows the service setting configs */
	public function showServiceSettingsPage() {
		$service_intro_text 		= Setting::where('key', '=', 'service_intro_text')->get();
		$service_sidebar_text 		= Setting::where('key', '=', 'service_sidebar_text')->get();
		$service_client_quote 		= Setting::where('key', '=', 'service_client_quote')->get();
		$service_page_photo 		= Setting::where('key', '=', 'service_page_photo')->get();	
		$this->layout->content 		= View::make('admin.settings.service_settings', compact('service_intro_text', 'service_sidebar_text', 'service_page_photo', 'service_client_quote'));
	}
	
	/* shows the service setting configs */
	public function showIvcSettingsPage() {
		$ivc_intro_text 		= Setting::where('key', '=', 'ivc_intro_text')->get();
		$ivc_client_text 		= Setting::where('key', '=', 'ivc_client_text')->get();
		$ivc_photo 				= Setting::where('key', '=', 'ivc_photo')->get();	
		$ivc_photo_caption 		= Setting::where('key', '=', 'ivc_photo_caption')->get();	
		$ivc_photo_content 		= Setting::where('key', '=', 'ivc_photo_content')->get();	
		$ivc_table_content 		= Setting::where('key', '=', 'ivc_table_content')->get();	
		$this->layout->content 	= View::make('admin.settings.ivc_settings', compact('ivc_intro_text', 'ivc_client_text', 'ivc_photo', 'ivc_photo_caption', 'ivc_photo_content', 'ivc_table_content'));
	}
	
	/* shows the service setting configs */
	public function showFoodSettingsPage() {
		$food_intro_text 		= Setting::where('key', '=', 'food_intro_text')->get();
		$food_client_text 		= Setting::where('key', '=', 'food_client_text')->get();
		$food_photo 			= Setting::where('key', '=', 'food_photo')->get();	
		$food_table_content 	= Setting::where('key', '=', 'food_table_content')->get();	
		$this->layout->content 	= View::make('admin.settings.food_settings', compact('food_intro_text', 'food_client_text', 'food_photo', 'food_table_content'));
	}
	
	/* shows the service setting configs */
	public function showClimateSettingsPage() {
		$climate_intro_text 		= Setting::where('key', '=', 'climate_intro_text')->get();
		$climate_client_text 		= Setting::where('key', '=', 'climate_client_text')->get();
		$climate_photo 			= Setting::where('key', '=', 'climate_photo')->get();	
		$climate_table_content 	= Setting::where('key', '=', 'climate_table_content')->get();	
		$this->layout->content 	= View::make('admin.settings.climate_settings', compact('climate_intro_text', 'climate_client_text', 'climate_photo', 'climate_table_content'));
	}
	
				
	/* shows the service setting configs */
	public function showCompanySettingsPage() {
		$company_intro_text 		= Setting::where('key', '=', 'company_intro_text')->get();
		$company_client_text 		= Setting::where('key', '=', 'company_client_text')->get();
		$company_photo 			= Setting::where('key', '=', 'company_photo')->get();	
		$company_table_content 	= Setting::where('key', '=', 'company_table_content')->get();	
		$this->layout->content 	= View::make('admin.settings.company_settings', compact('company_intro_text', 'company_client_text', 'company_photo', 'company_table_content'));
	}	
	
	/* update all the service settings */
	public function updateServiceSettings() {
		$data = Input::all();
		if ($data['service_intro_text'] != '') {
			Setting::where('key', '=', 'service_intro_text')->update(array('value' => $data['service_intro_text']));	
		}
		
		if ($data['service_sidebar_text'] != '') {
			Setting::where('key', '=', 'service_sidebar_text')->update(array('value' => $data['service_sidebar_text']));	
		}	
		
		if ($data['service_client_quote'] != '') {
			Setting::where('key', '=', 'service_client_quote')->update(array('value' => $data['service_client_quote']));	
		}				
		
		if(Input::file('service_page_photo')!=''){
			$service_page_photo 		= Setting::where('key', '=', 'service_page_photo')->get();
			$destinationPath 	= public_path().'/assets/';
			File::delete($destinationPath . $service_page_photo[0]->photo);
			File::delete($destinationPath . $service_page_photo[0]->photo);
			$file = Input::file('service_page_photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['service_page_photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);	
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(735, null, function ($constraint) {
				$constraint->aspectRatio();
			});				
			$img->save($destinationPath."th_".$filename);
			unlink($destinationPath.$filename);	
			Setting::where('key', '=', 'service_page_photo')->update(array('value' => $filename));	
		}	
										
		return Redirect::to('admin/service_settings')->with('success_message','Service settings updated sucessfully');		
	}
	
	/* update all the ivc settings */
	public function updateIvcSettings() {
		$data = Input::all();
		if ($data['ivc_intro_text'] != '') {
			Setting::where('key', '=', 'ivc_intro_text')->update(array('value' => $data['ivc_intro_text']));	
		}
		
		if ($data['ivc_client_text'] != '') {
			Setting::where('key', '=', 'ivc_client_text')->update(array('value' => $data['ivc_client_text']));	
		}		
		
		if ($data['ivc_photo'] != '') {
			Setting::where('key', '=', 'ivc_photo')->update(array('value' => $data['ivc_photo']));	
		}	
		
		if(Input::file('ivc_photo')!=''){
			$service_page_photo 		= Setting::where('key', '=', 'ivc_photo')->get();
			$destinationPath 	= public_path().'/assets/';
			File::delete($destinationPath . $service_page_photo[0]->photo);
			File::delete($destinationPath . $service_page_photo[0]->photo);
			$file = Input::file('ivc_photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['ivc_photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);	
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(383, null, function ($constraint) {
				$constraint->aspectRatio();
			});				
			$img->save($destinationPath."th_".$filename);
			unlink($destinationPath.$filename);	
			Setting::where('key', '=', 'ivc_photo')->update(array('value' => $filename));	
		}		
		
		if ($data['ivc_photo_caption'] != '') {
			Setting::where('key', '=', 'ivc_photo_caption')->update(array('value' => $data['ivc_photo_caption']));	
		}			
				
		if ($data['ivc_photo_content'] != '') {
			Setting::where('key', '=', 'ivc_photo_content')->update(array('value' => $data['ivc_photo_content']));	
		}	
		if ($data['ivc_table_content'] != '') {
			Setting::where('key', '=', 'ivc_table_content')->update(array('value' => $data['ivc_table_content']));	
		}							
										
		return Redirect::to('admin/ivc_settings')->with('success_message','Service settings updated sucessfully');		
	}	
	
	/* update all the food settings */
	public function updateFoodSettings() {
		$data = Input::all();
		if ($data['food_intro_text'] != '') {
			Setting::where('key', '=', 'food_intro_text')->update(array('value' => $data['food_intro_text']));	
		}
		
		if ($data['food_client_text'] != '') {
			Setting::where('key', '=', 'food_client_text')->update(array('value' => $data['food_client_text']));	
		}		
		
		if ($data['food_photo'] != '') {
			Setting::where('key', '=', 'food_photo')->update(array('value' => $data['food_photo']));	
		}	
		
		if(Input::file('food_photo')!=''){
			$service_page_photo 		= Setting::where('key', '=', 'food_photo')->get();
			$destinationPath 	= public_path().'/assets/';
			File::delete($destinationPath . $service_page_photo[0]->photo);
			File::delete($destinationPath . $service_page_photo[0]->photo);
			$file = Input::file('food_photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['food_photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);	
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(383, null, function ($constraint) {
				$constraint->aspectRatio();
			});				
			$img->save($destinationPath."th_".$filename);
			unlink($destinationPath.$filename);	
			Setting::where('key', '=', 'food_photo')->update(array('value' => $filename));	
		}		
		
		if ($data['food_table_content'] != '') {
			Setting::where('key', '=', 'food_table_content')->update(array('value' => $data['food_table_content']));	
		}							
										
		return Redirect::to('admin/food_settings')->with('success_message','Settings updated sucessfully');		
	}	
	
	/* update all the food settings */
	public function updateClimateSettings() {
		$data = Input::all();
		if ($data['climate_intro_text'] != '') {
			Setting::where('key', '=', 'climate_intro_text')->update(array('value' => $data['climate_intro_text']));	
		}
		
		if ($data['climate_client_text'] != '') {
			Setting::where('key', '=', 'climate_client_text')->update(array('value' => $data['climate_client_text']));	
		}		
		
		if ($data['climate_photo'] != '') {
			Setting::where('key', '=', 'climate_photo')->update(array('value' => $data['climate_photo']));	
		}	
		
		if(Input::file('climate_photo')!=''){
			$service_page_photo 		= Setting::where('key', '=', 'climate_photo')->get();
			$destinationPath 	= public_path().'/assets/';
			File::delete($destinationPath . $service_page_photo[0]->photo);
			File::delete($destinationPath . $service_page_photo[0]->photo);
			$file = Input::file('climate_photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['climate_photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);	
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(383, null, function ($constraint) {
				$constraint->aspectRatio();
			});				
			$img->save($destinationPath."th_".$filename);
			unlink($destinationPath.$filename);	
			Setting::where('key', '=', 'climate_photo')->update(array('value' => $filename));	
		}		
		
		if ($data['climate_table_content'] != '') {
			Setting::where('key', '=', 'climate_table_content')->update(array('value' => $data['climate_table_content']));	
		}							
										
		return Redirect::to('admin/climate_settings')->with('success_message','Settings updated sucessfully');		
	}	

	/* update all the food settings */
	public function updateCompanySettings() {
		$data = Input::all();
		if ($data['company_intro_text'] != '') {
			Setting::where('key', '=', 'company_intro_text')->update(array('value' => $data['company_intro_text']));	
		}
		
		if ($data['company_client_text'] != '') {
			Setting::where('key', '=', 'company_client_text')->update(array('value' => $data['company_client_text']));	
		}		
		
		if ($data['company_photo'] != '') {
			Setting::where('key', '=', 'company_photo')->update(array('value' => $data['company_photo']));	
		}	
		
		if(Input::file('company_photo')!=''){
			$service_page_photo 		= Setting::where('key', '=', 'company_photo')->get();
			$destinationPath 	= public_path().'/assets/';
			File::delete($destinationPath . $service_page_photo[0]->photo);
			File::delete($destinationPath . $service_page_photo[0]->photo);
			$file = Input::file('company_photo');
			$filename = md5(time()) . "." . $file->getClientOriginalExtension();
			$data['company_photo'] = $filename;
			if ($file->isValid()){
				$file->move($destinationPath, $filename);	
			}
			$img = Image::make($destinationPath.$filename);
			$img->resize(383, null, function ($constraint) {
				$constraint->aspectRatio();
			});				
			$img->save($destinationPath."th_".$filename);
			unlink($destinationPath.$filename);	
			Setting::where('key', '=', 'company_photo')->update(array('value' => $filename));	
		}		
		
		if ($data['company_table_content'] != '') {
			Setting::where('key', '=', 'company_table_content')->update(array('value' => $data['company_table_content']));	
		}							
										
		return Redirect::to('admin/company_settings')->with('success_message','Settings updated sucessfully');		
	}
	
	public function saveConstants() {
		$hidden_vals 		= array();
		$content_english 	= array();
		$content_nepali 	= array();
		$hidden_vals 		= Input::get('hidden_vals');
		$content_english 	= Input::get('content_english');
		$content_nepali 	= Input::get('content_nepali');
		foreach($hidden_vals as $key=>$val) {
			Constant::where('title', '=', $val)->update(array('content_english' => $content_english[$key], 'content_nepali' => $content_nepali[$key]));
		}	
		return Redirect::route('admin.settings.index')->with('success_message','Settings updated sucessfully');		
	}	

}
