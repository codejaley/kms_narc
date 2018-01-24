	<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/mockjax/jquery.mockjax.js"></script>
<script src="/admin_root/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="/admin_root/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="/admin_root/css/plugins/datepicker/datepicker.css">
<link rel="stylesheet" href="/admin_root/css/plugins/multiselect/multi-select.css">

	<script src="/admin_root/js/jquery.min.js"></script>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Books</h1>
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
									Book Listings
								</h3>
									
								<nav align="right">
										<ul>
										   <li>
										   <a href="{{ Request::root() }}/admin/books/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>									
									
																	
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Name(Nepali)</th>
											<th>Description</th>
											<th>Description(Nepali)</th>
											<th>Category</th>
											<th>Submitted by</th>
											<th>Status</th>
											<th>View</th>
<!--											<th>Edit</th>
											<th>Delete</th>-->
										</tr>
									</thead>
									<tbody>
									<?php foreach($books as $project) { ?>
											<tr>
												<td><?php echo $project->name; ?></td>
												<td><?php echo $project->name_nepali; ?></td>
												<td><?php echo $project->description; ?></td>
												<td><?php echo $project->description_nepali; ?></td>
												<td><?php echo $project->OrmCategory->name; ?></td>
												<td><?php echo $project->OrmUser->firstname . ' ' . $project->OrmUser->lastname; ?></td>
												<td>
													<?php
														if($project->is_active == 1) {
													?>
														<p style="color:#99CC33">Active</p> <a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/books/change_status/d/{{ $project->id }}"><i class="icon-remove"></i> Deactivate</a>
													<?php } else { ?>
														<p style="color:#FF0000">Deactive</p> <a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/books/change_status/a/{{ $project->id }}"><i class="icon-reply"></i> Activate Now</a>
													<?php } ?>
												</td>												
												<td><i class="glyphicon-display"></i> <a href="{{ Request::root() }}/admin/books/{{ $project->id }}">Show</a></td>												
<?php /*?>												<td><a href="{{ Request::root() }}/admin/books/manage_book/{{ $project->id }}"><i class="icon-edit"></i> Edit</a></td>
												<td><a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/books/delete/{{ $project->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	<?php */?>
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
				</div>				
</div>