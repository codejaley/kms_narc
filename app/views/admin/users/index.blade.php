<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Users</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Home</a>
							<i class="icon-angle-right"></i>
						</li>
					</ul>
					
				</div>
<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									User Listings
								</h3>
								<nav align="right">
										<ul style="list-style:none">
										   <li>
		{{ Form::select('user_type', $roles , $selected_role, array('id'=> 'user_select_type')) }}	
										   </li>
										   <li>
										   <a href="{{ Request::root() }}/admin/users/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover dataTable table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Username</th>
											<th>Type</th>
											<th>Status</th>
											<th>Edit</th>
											<th>Change Password </th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($users as $entry) { ?>
											<tr>
												<td><?php echo $entry->firstname; ?></td>
												<td>{{ $entry->username }}</td>
												<td>
													<?php if ($entry->role_id == 1) { ?>
														Super Admin
													<?php } else if ($entry->role_id == 2) { ?>
														Library Admin
													<?php } else if($entry->role_id == 3) { ?>
														Registered Users
													<?php }  else if($entry->role_id == 4) {?>	
														Author	
													<?php } ?>										
													</td>
												<td>
													<?php
														if($entry->is_active == 1) {
													?>
														<p style="color:#99CC33">Active</p> <a onclick="return window.confirm('Are you sure?');" href="{{ Request::root() }}/admin/users/change_status/d/{{ $entry->id }}"><i class="icon-remove"></i> Deactivate</a>
													<?php } else { ?>
														<p style="color:#FF0000">Deactive</p> <a onclick="return window.confirm('Are you sure?');" href="{{ Request::root() }}/admin/users/change_status/a/{{ $entry->id }}"><i class="icon-reply"></i> Activate Now</a>
													<?php } ?>												</td>
															
<td><a href="{{ Request::root() }}/admin/users/{{ $entry->id }}/edit"><i class="icon-edit"></i> Edit</a></td>												
												<td><a href="{{ Request::root() }}/admin/users/reset/{{ $entry->id }}"> Reset</a></td>
												<td><a onclick="return window.confirm('Are you sure?');" href="{{ Request::root() }}/admin/delete/user/{{ $entry->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
				</div>				
				
</div>

<script>
$(document).ready(function() {
	$('#user_select_type').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		location.href = '{{ Request::root() }}/admin/users?type=' + optionSelected.val();
	});
});
</script>