<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/mockjax/jquery.mockjax.js"></script>
<script src="/admin_root/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="/admin_root/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="/admin_root/css/plugins/datepicker/datepicker.css">
<link rel="stylesheet" href="/admin_root/css/plugins/multiselect/multi-select.css">

<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Your Items</h1>
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
									Item Listings
								</h3>
								<div>

								</div>
								<div>

								</div>
																	
									
																	
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover dataTable table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Name(Nepali)</th>
											<th>Category</th>
											<!--<th>Submitted by</th>-->
											<th>Status</th>
											<th>View</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($books as $project) { ?>
											<tr>
												<td><?php echo $project->name; ?></td>
												<td><?php echo $project->name_nepali; ?></td>
												<td><?php echo $project->OrmCategory->name; ?></td>
												<?php /*?><td><?php echo $project->user_id; ?></td><?php */?>
												<td>
													<?php
														$book_status = ($project->is_active == 1)?'Active' : 'Pennding approval';
														echo $book_status;
													?>
												</td>												
												<td><i class="glyphicon-display"></i> <a href="{{ Request::root() }}/admin/books/{{ $project->id }}">Show</a></td>												
												<td><a href="{{ Request::root() }}/admin/books/manage_book/{{ $project->id }}"><i class="icon-edit"></i> Edit</a></td>
												<td><a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/books/delete/{{ $project->id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
								<?php /*?>{{ $books->links() }}<?php */?>
							</div>
						</div>
					</div>
				
				</div>				
</div>
<script type="text/javascript">
	
	$( "#category_filter").change(function() {
		var jcategory_id = $("#category_filter").val();
		window.location = "{{ Request::root() }}/admin/books?category_id=" + jcategory_id;
	});
	$( "#author_filter").change(function() {
		var jauthor_id = $("#author_filter").val();
		window.location = "{{ Request::root() }}/admin/books?author_id=" + jauthor_id;
	});
</script>