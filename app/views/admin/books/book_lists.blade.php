	<script src="/admin_root/js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#project_type').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		location.href = '{{ Request::root() }}/admin/books?project=' + optionSelected.val();
	});
});
</script>
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
									
									<div style="float:right;padding-left:20px;">
											{{ Form::select('project_type', $categories , $category_id, array('id'=> 'project_type')) }}										
									</div>
									
																	
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Status</th>
											<th>Published Date</th>
											<th>View</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($books as $book) { ?>
											<tr>
												<td><?php echo $book->name; ?></td>
												
												<td>
													<?php
														if($book->is_active == 1) {
													?>
														<p style="color:#99CC33">Active</p> <a href="{{ Request::root() }}/admin/books/change_status/d/{{ $book->id }}"><i class="icon-remove"></i> Deactivate</a>
													<?php } else { ?>
														<p style="color:#FF0000">Deactive</p> <a href="{{ Request::root() }}/admin/books/change_status/a/{{ $book->id }}"><i class="icon-reply"></i> Activate Now</a>
													<?php } ?>
												</td>												
												<td><?php echo $book->start_date; ?></td>
												<td><i class="glyphicon-display"></i> <a href="{{ Request::root() }}/admin/books/{{ $book->id }}">Show</a></td>												
												<td><a href="{{ Request::root() }}/admin/books/manage_book/{{ $book->id }}"><i class="icon-edit"></i> Edit</a></td>
												<td><a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/books/delete/{{ $book->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
				</div>				
				
{{ $books->appends($query_strings)->links(); }}
</div>