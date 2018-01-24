<?php

class PermissionController extends \BaseController {
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin');
	}		
	/**
	 * Display a listing of the resource.
	 * GET /permission
	 *
	 * @return Response
	 */
	public function index()
	{
		$heading = '';
		$role_modules = RoleModule::all();
		$modules = Module::all();
		$menus = $this->recursivePanel(0,0);
		$groups1 = RoleModule::where('is_active', '=', 1)->get();
		
		foreach($groups1 as $key=>$val){
			$heading .= "<span class="."per-block".">" . $val->name . "</span>";
		}	
		
		$this->layout->content = View::make('admin.manage_permission', compact('role_modules', 'modules', 'menus', 'heading'));
	}
	
	
	/* show the recorsive permission panel */
	public function recursivePanel($parent_id, $n=0) {
		$query = "SELECT
						modules.id,
						modules.module_name,
						modules.module_link,
						COUNT(modules1.module_name)as child 
					FROM 
						modules
						LEFT JOIN modules modules1	ON(modules1.parent_id=modules.id)
					WHERE 1=1
						 AND modules.parent_id= " .  $parent_id . "
					GROUP BY
							modules.id,modules.module_name,modules.module_link";
		$menus = DB::select(DB::raw($query));	
		$groups = RoleModule::where('is_active', '=', 1)->get();	
		$str = '';

		foreach($menus as $menu) {
			if ($menu->child == 0) {
				$str.="<li class="."admin_menus"."><span class="."per-block".">".$menu->module_name."</span>";				
				foreach($groups as $key=>$val) {
					$chk  = $this->checkPermission($menu->id,$val->id);
					$str .= "<span class="."per-block".">"."<input type='checkbox' ".$chk." name='chk[]' onclick='setPermission(this)' value=".$menu->id."_".$val->id."></span>";					
				}
				$str.="</li>";
			} else {
				$str.="<li class="."admin_menus "."><span class="."per-block"."><b>".$menu->module_name."</b></span>";
				foreach($groups as $key=>$val){
					$chk = $this->checkPermission($menu->id,$val->id);

					$str.="<span class="."per-block".">"."<input type='checkbox' ".$chk." name='chk[]' onclick='setPermission(this)' value=".$menu->id."_".$val->id."></span>";
				}

				$str .= "<ul>";
				$str .= $this->recursivePanel($menu->id,-1);

				$str .= "</ul>";
				$str .= "</li>";				
			}


		}		
		return $str;
	}
	
	/* check permission and populate checkbox */
	public function checkPermission($module_id, $role_id) {
		$count = RoleModulePermission::where('module_id', '=', $module_id)->where('role_module_id', '=',$role_id)->count();
		$chk   = ($count == 1) ? "checked=checked" : "false";
		return $chk;
	}

	/* ajax update permission */
	public function updatePermission($module_id, $role_module_id, $flag) {
			if($flag == 'true') {
				$data = array('module_id' => $module_id, 'role_module_id' => $role_module_id);
				RoleModulePermission::create($data);
			} else if ($flag == 'false') {
				RoleModulePermission::where('module_id', '=', $module_id)
										->where('role_module_id', '=', $role_module_id)
										->delete();
			}
		die;		
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /permission/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /permission
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /permission/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /permission/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /permission/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /permission/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}