<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pages</h1>
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
									Pages Listings
								</h3>
								<nav align="right">
										<ul>
										   <li>
										   <a href="{{ Request::root() }}/admin/pages/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Page</th>
											<th>Status</th>
											<th>View</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($pages as $entry) { ?>
											<tr>
												<td><?php echo $entry->title; ?></td>
												<td>
													<?php
														if($entry->is_active == 1) {
													?>
														<p style="color:#99CC33">Active</p> <a href="{{ Request::root() }}/admin/pages/change_status/d/{{ $entry->id }}"><i class="icon-remove"></i> Deactivate</a>
													<?php } else { ?>
														<p style="color:#FF0000">Deactive</p> <a href="{{ Request::root() }}/admin/pages/change_status/a/{{ $entry->id }}"><i class="icon-reply"></i> Activate Now</a>
													<?php } ?>
												</td>												
												<td><i class="glyphicon-display"></i> <a href="{{ Request::root() }}/admin/pages/show/{{ $entry->id }}">Show</a></td>
												<td><a href="{{ Request::root() }}/admin/pages/{{ $entry->id }}/edit"><i class="icon-edit"></i> Edit</a></td>
												<td><a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/pages/delete/{{ $entry->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
				</div>				
				
{{ $pages->links(); }}
</div>