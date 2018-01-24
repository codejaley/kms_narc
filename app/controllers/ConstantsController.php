<?php

class ConstantsController extends \BaseController {
	
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin');
	}	
	
	/**
	 * Display a listing of blogs
	 *
	 * @return Response
	 */
	public function index()
	{
		$constants = Constant::orderBy('ordering', 'ASC')->orderBy('id', 'DESC')->get();
		$this->layout->content = View::make('admin.constants.index', compact('constants'));
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
		return Redirect::route('admin.constants.index');
	}

}
