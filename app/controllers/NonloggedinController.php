<?php
class NonloggedinController extends BaseController {
	protected $layout = "frontend.home-layout";
	
	/* show the static page content */
	public function showPageContent($slug)
	{		
		$page = Page::where('slug', '=', $slug)->where('is_active', '=', '1')->get();		
		$this->layout->content = View::make('frontend.page', compact('page'));
	}		
}