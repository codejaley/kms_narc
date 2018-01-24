<?php

class AdminController extends \BaseController {
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin');
	}		
	
	/**
	 * Display a listing of states
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		$permitted_fields = RoleModulePermission::Join('modules','modules.id','=','role_module_permissions.module_id')->where('role_module_id','=',1)->lists('module_id');
		
		$parent_blocks = Module::orderBy('id', 'asc')->whereIn('id',$permitted_fields)->get()->toArray();
		$theArray = array_filter($parent_blocks, function($v) { return $v['parent_id'] == 0; });
		//echo "<pre>";
		//print_r($theArray);
		//exit;
		$data_tree = array();

		foreach ($theArray as $key => $item) {
			$data_tree[$key]['parent'] = $item;
			$item_id = $item['id'];
			$data_tree[$key]['child'] = array_filter($parent_blocks, function($v) use ($item_id)  { return $v['parent_id'] == $item_id; });
			//$role_module = 
			

		}
		//echo "<pre>";
		//print_r($data_tree);
		//exit;
		$this->layout->content = View::make('admin.dashboard_new',compact('data_tree'));
		//$dashboard_view = (Auth::user()->role_id == 3)?'admin.dashboard-user' : 'admin.dashboard';
		//$this->layout->content= View::make($dashboard_view);
	}
	
	/* change admin password */
	public function changePassword() {
		$this->layout->content = View::make('admin.users.change_password');
	}
	
	public function updatePassword() {
		$messages = array(
			'password.required' 	=> 'Password is required',
		  );
		  
		$rules = array(
			'password' 					=> 'required|confirmed'
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}	
		
		$data['password'] = Hash::make(Input::get('password'));
		User::where('id', '=', Auth::user()->id)->update($data);			
		return Redirect::to('admin/change_password')->with('success_message','Password changed sucessfully');
	}		
	
}
