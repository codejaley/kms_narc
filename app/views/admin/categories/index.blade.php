<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Item Categories</h1>
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
									Category Listings
								</h3>
								<div>

								</div>
										
								<nav align="right">
										<ul style="list-style:none">
											<li>
												<div class="control-group">
													<label for="textfield" class="control-label">Select with search</label>
													<div class="controls">
														<div class="input-xlarge">
															{{ Form::open(array('url' => 'admin/categories')) }}
															{{ Form::select('category_id',$list_categories,$category_id,array('class' => 'chosen-select','id' => 'category_filter')) }}
															{{ Form::close() }}</div>
													</div>
												</div>
											</li>

										   <li>
										   		<a href="{{ Request::root() }}/admin/categories/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>								
							</div>
							<div class="box-content nopadding">
								<table class="table table-responsive dataTable table-bordered">
										<thead>
										  <tr>
											<th>Category Name</th>
										  </tr>
										</thead>
										<tbody>
										  @foreach($categories as $entry)
											  <tr>
												<td>{{ $entry->name }} ({{ $entry->name_nepali }})
												
														<div style='float:right;padding-right:12px;'>
																	<span><a href="{{ Request::root() }}/admin/books/lists/{{ $entry->id }}">View Items</a> | </span>
																	<span>
																		<?php
																			if ($entry->is_active == 1) {
																		?>
																			<font style="color:#99CC33">Active</font>
																		<?php } else { ?>
																			<font style="color:#FF0000">Deactive</font>													
																		<?php } ?>
																	</span>	
																	<span>| &nbsp;</span>															
															<span><a href="{{ Request::root() }}/admin/categories/{{ $entry->id }}/edit"><i class="icon-edit">Edit</i></a></span>
														
															|
															<span><a onclick="return window.confirm('Are you sure?');" href='{{Request::root()}}/admin/categories/delete/{{$entry->id}}'><i class="icon-trash">Delete</i></a></span>
														</div>				
													<?php foreach($entry['children'] as $child_model_1) { ?>
														<ul style="list-style:none;padding:5px;">
															<li style="padding-left:20px;">
																<i class="icon-arrow-right"></i> <?php echo $child_model_1->name;?> (<?php echo $child_model_1->name_nepali;?>)
									
																<div style='float:right'>
																	
																	<span><a href="{{ Request::root() }}/admin/books/lists/{{ $child_model_1->id }}">View Books</a> | </span>
																	<span>
																		<?php
																			if ($child_model_1->is_active == 1) {
																		?>
																			<font style="color:#99CC33">Active</font>
																		<?php } else { ?>
																			<font style="color:#FF0000">Deactive</font>													
																		<?php } ?>
																	</span>
																	<span><a href="{{ Request::root() }}/admin/categories/{{ $child_model_1->id }}/edit"><i class="icon-edit">Edit</i></a></span> | <span><a onclick="return window.confirm('Are you sure?');" href='{{Request::root()}}/admin/categories/delete/{{$entry->id}}'><i class="icon-trash">Delete</i></a></span>
																</div>
															</li>
														</ul>
														
														<?php foreach($child_model_1['children'] as $child_model_2) { ?>
															<ul style="list-style:none;padding:5px;">
																<li style="padding-left:40px;">
																	<i class="icon-arrow-right"></i> <?php echo $child_model_2->name;?> (<?php echo $child_model_2->name_nepali;?>)
																	<div style='float:right'>
																	<span><a href="{{ Request::root() }}/admin/books/lists/{{ $child_model_2->id }}">View Books</a> | </span>																	
																	<span>
																		<?php
																			if ($child_model_2->is_active == 1) {
																		?>
																			<font style="color:#99CC33">Active</font>
																		<?php } else { ?>
																			<font style="color:#FF0000">Deactive</font>													
																		<?php } ?>
																	</span>																			
																		<span><a href="{{ Request::root() }}/admin/categories/{{ $child_model_2->id }}/edit"><i class="icon-edit">Edit</i></a></span> | <span><a onclick="return window.confirm('Are you sure?');" href='{{Request::root()}}/admin/categories/delete/{{$entry->id}}'><i class="icon-trash">Delete</i></a></span>
																	</div>
																</li>
															</ul>
															
															<?php foreach($child_model_2['children'] as $child_model_3) { ?>
																<ul style="list-style:none;padding:5px;">
																	<li style="padding-left:60px;">
																		<i class="icon-arrow-right"></i> <?php echo $child_model_3->name;?> (<?php echo $child_model_3->name_nepali;?>)
																		<div style='float:right'>
																	<span><a href="{{ Request::root() }}/admin/books/lists/{{ $child_model_3->id }}">View Books</a> | </span>																		
																	<span>
																		<?php
																			if ($child_model_3->is_active == 1) {
																		?>
																			<font style="color:#99CC33">Active</font>
																		<?php } else { ?>
																			<font style="color:#FF0000">Deactive</font>													
																		<?php } ?>
																	</span>																				
																			<span><a href="{{ Request::root() }}/admin/categories/{{ $child_model_3->id }}/edit"><i class="icon-edit">Edit</i></a></span> | <span><a onclick="return window.confirm('Are you sure?');" href='{{Request::root()}}/admin/categories/delete/{{$entry->id}}'><i class="icon-trash">Delete</i></a></span>
																		</div>
																	</li>
																</ul>
															<?php } ?>								
															
														<?php } ?>						
														
													<?php } ?>
												</td>		   
											  </tr>
										  @endforeach 
										</tbody>
									  </table>	

							</div>
						</div>
					</div>
				
				</div>				
				
</div>
<script type="text/javascript">	
	$( "#category_filter").change(function() {
		var jcategory_id = $("#category_filter").val();
		window.location = "{{ Request::root() }}/admin/categories?parent_id=" + jcategory_id;
	});
</script>