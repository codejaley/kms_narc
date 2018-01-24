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
									Email Unverified User Listings
								</h3>
																
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover dataTable table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Username</th>
											<th>Type</th>
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
												<td><a onclick="return window.confirm('Are you sure?');" href="{{ Request::root() }}/admin/delete/user/{{ $entry->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
				</div>				
				
{{ $users->appends($query_strings)->links(); }}
</div>