<div id="navigation">
		<div class="container-fluid">
			<a href="{{ Request::root() }}/admin" id="brand">{{ Config::get('admin-constants.AMIN_PANEL_CAPTION') }}</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
				<li class='active'>
					<a href="{{ Request::root() }}/admin">
						<span>Dashboard</span>
					</a>
				</li>
									
					<li>
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<span>Items</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
								<?php if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) { ?>	
								<li>
									<a href="{{ Request::root() }}/admin/categories">Categories</a>
								</li>
								<?php } ?>
							<?php if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) { ?>	
							<li>
								<a href="{{ Request::root() }}/admin/verify/books">Verify submitted items</a>
							</li>	
							<?php } ?>
							<?php if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) { ?>	
							<li>
								<a href="{{ Request::root() }}/admin/books">List of Items</a>
							</li>
							<?php } ?>
							
							<?php if (Auth::user()->role_id == 3) { ?>
								<li>
									<a href="{{ Request::root() }}/admin/your_books">Your Items</a>
								</li>
							<?php } ?>
							
							<li>
								<a href="{{ Request::root() }}/admin/books/create">Add new item</a>
							</li>		
																	
						</ul>
					</li>				
				
				
				
				<?php if (Auth::user()->role_id == 1) { ?>		
				<li>
						<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
							<span>Users</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ Request::root() }}/admin/users?type=1">Super Admin</a>
							</li>
							<li>
								<a href="{{ Request::root() }}/admin/users?type=2">Library Admin</a>
							</li>
							<li>
								<a href="{{ Request::root() }}/admin/users?type=4">Authors</a>
							</li>
							<li>
								<a href="{{ Request::root() }}/admin/users?type=3">Show users</a>
							</li>
							<li>
								<a href="{{ Request::root() }}/admin/users/verify">Verify new user</a>
							</li>			
							<li>
								<a href="{{ Request::root() }}/email_unverified_user">Show email unverified user</a>
							</li>														
						</ul>
					</li>							
				<?php } ?>
			
			<?php if (Auth::user()->role_id == 1) { ?>		
					<li>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">																								
						<li>
							<a href="{{ Request::root() }}/admin/settings">General setttings</a>
						</li>
					</ul>
				</li>	
				
				<?php } ?>
				<?php if (Auth::user()->role_id == 1) { ?>		
					<li>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Permission Management</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">																								
						<li>
							<a href="{{ Request::root() }}/admin/permission">Manage permission</a>
						</li>
					</ul>
				</li>	
				
				<?php } ?>
				
			</ul>
			
			<div class="user">

				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Hi, {{ Auth::user()->firstname }} <img src="/admin_root/img/demo/user-avatar.jpg" alt=""></a>
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