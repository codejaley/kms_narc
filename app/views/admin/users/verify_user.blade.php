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
										<ul>
										</ul>
									</nav>								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover dataTable table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Username</th>
											<th>Verified</th>
											<th>Request Date</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($users as $entry) { ?>
											<tr>
												<td><?php echo $entry->firstname; ?></td>
												<td>{{ $entry->username }}</td>
												<td>
													<?php
														if($entry->is_user_verified == 1) {
													?>
														<p style="color:#99CC33">Active</p> <a onclick="return window.confirm('Are you sure?');" href="{{ Request::root() }}/admin/users/change_status/d/{{ $entry->id }}"><i class="icon-remove"></i> Deactivate</a>
													<?php } else { ?>
														<p style="color:#FF0000">Deactive</p> <a onclick="return window.confirm('Are you sure?');" href="{{ Request::root() }}/admin/users/change_status/a/{{ $entry->id }}"><i class="icon-reply"></i> Verify</a>
													<?php } ?>												</td>
												<td>{{ $entry->updated_at }}</td>
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