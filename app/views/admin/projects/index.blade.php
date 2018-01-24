	<script src="/admin_root/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#project_type').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		location.href = '{{ Request::root() }}/admin/projects?project=' + optionSelected.val();
	});
});
</script>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>{{ Config::get('admin-field-constants.PROJECT_PAGE_TITLE') }}</h1>
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
									Project Listings
								</h3>
									
								<nav align="right">
										<ul>
										   <li>
										   <a href="{{ Request::root() }}/admin/projects/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>									
									
									<div style="float:right;padding-left:20px;">
											{{ Form::select('project_type', array('0' => 'Filter Project','past' => 'Completed', 'present' => 'Current') , $project_type, array('id'=> 'project_type')) }}										
									</div>
									
																	
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Show in front</th>
											<th>Status</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>View</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($projects as $project) { ?>
											<tr>
												<td><?php echo $project->title; ?></td>
												<td>
													<?php if ($project->is_front == 1) { ?>
<p style="color:#99CC33">Yes</p> <a href="{{ Request::root() }}/admin/projects/add_to_front/y/{{ $project->id }}"><i class="icon-remove"></i> Remove from front</a>														
													<?php } else { ?>
														<p style="color:#FF0000">No</p> <a href="{{ Request::root() }}/admin/projects/add_to_front/n/{{ $project->id }}"><i class="icon-reply"></i> Add to front</a>
													<?php } ?>
												</td>
												<td>
													<?php
														if($project->is_active == 1) {
													?>
														<p style="color:#99CC33">Active</p> <a href="{{ Request::root() }}/admin/projects/change_status/d/{{ $project->id }}"><i class="icon-remove"></i> Deactivate</a>
													<?php } else { ?>
														<p style="color:#FF0000">Deactive</p> <a href="{{ Request::root() }}/admin/projects/change_status/a/{{ $project->id }}"><i class="icon-reply"></i> Activate Now</a>
													<?php } ?>
												</td>												
												<td><?php echo $project->start_date; ?></td>
												<td><?php echo $project->end_date; ?></td>
												<td><i class="glyphicon-display"></i> <a href="{{ Request::root() }}/admin/projects/{{ $project->id }}">Show</a></td>												
												<td><a href="{{ Request::root() }}/admin/projects/manage_project/{{ $project->id }}"><i class="icon-edit"></i> Edit</a></td>
												<td><a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/projects/delete/{{ $project->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
				</div>				
				
{{ $projects->appends($query_strings)->links(); }}
</div>