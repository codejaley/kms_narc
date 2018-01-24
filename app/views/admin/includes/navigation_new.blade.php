<?php 
	$permitted_fields = RoleModulePermission::Join('modules','modules.id','=','role_module_permissions.module_id')
											->where('role_module_id','=',Auth::user()->role_id)
											->lists('module_id');
		
		$parent_blocks = Module::orderBy('module_position', 'asc')
										->where('is_active', '=', 1)
										->whereIn('id',$permitted_fields)->get()->toArray();
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
?>
<div id="navigation">
		<div class="container-fluid">
			<a href="{{ Request::root() }}/admin" id="brand"><img src="{{Request::root()}}/images/admin-logo.png"> </a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
				<li class='active'>
					<a href="{{ Request::root() }}/admin">
						<span>Dashboard</span>
					</a>
				</li>
				@foreach($data_tree as $key => $item)
				<li>
					@if(count($item['child']) > 0)
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<span>{{ $item['parent']['module_name']}}</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							@foreach ($item['child'] as $key1 => $value)
								<li>
								<a href="{{ Request::root() }}/{{ $value['module_link']}}">{{ $value['module_name'] }}</a>
							</li>
							@endforeach
						</ul>
					@endif
				</li>
				@endforeach	

				<li>
					
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<span>Others</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							
								<li>
								<a href="{{ Request::root() }}/admin/backup">Database Backup</a>
								<a href="{{ Request::root() }}/">Report</a>
							</li>
						
						</ul>
					
				</li>
				
			</ul>
			
			<div class="user">

				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Hi, {{ Auth::user()->firstname }} <img src="/images/user.png" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="{{ Request::root() }}/admin/change_password">Change Password</a>
						</li>
						<li>
							<a href="{{ Request::root() }}/admin/logout">Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>