<link rel="stylesheet" href="/admin_root/css/plugins/datepicker/datepicker.css">
<link rel="stylesheet" href="/admin_root/css/plugins/multiselect/multi-select.css">
<script src="/admin_root/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin_root/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>

<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Items</h1>
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
						<div class="box-title">
							<nav align="right">
								<ul style="padding-top:10px">
								   <li style="list-style:none">
								   <a href="{{ Request::root() }}/admin/books" class="btn btn-primary">Books</a>
								   </li>
								</ul>
							</nav>						
						</div>
						<div class="box box-color">
							<div class="box-title">
								<h3>
									<i class="icon-reorder"></i>
									Manage Book
								</h3>
								<ul class="tabs">
									<li class="<?php if (Input::get('tab') == 1 || !Input::get('tab')) echo 'active';?>">
										<a href="#t1" data-toggle="tab">Book Info</a>
									</li>
									<li class="<?php if (Input::get('tab') == 2) echo 'active';?>">
										<a href="#t2" data-toggle="tab">Upload Documents</a>
									</li>
									<li class="<?php if (Input::get('tab') == 3) echo 'active';?>">
										<a href="#t3" data-toggle="tab">Manage meta tags</a>
									</li>																										
								</ul>
							</div>
							<div class="box-content">
								<div class="tab-content">
									<div class="tab-pane <?php if (Input::get('tab') == 1 || !Input::get('tab')) echo 'active';?>" id="t1">
										<h4>Edit Project Sheet</h4>
									<div class="span12">
										<div class="box">

<div class="box-content">
{{ Form::model($book, array('method' => 'PATCH', 'route' => array('admin.books.update', $book->id),'files' => true)) }}	
<div class="control-group">
			<label for="textfield" class="control-label"><strong>Book Name</strong></label>
			<div class="controls">
				 {{ Form::text('name', null, array('class'=>'input-xxlarge', 'placeholder'=>'')) }}				
			</div>
		</div>
	
		<div class="control-group">
			<label for="textfield" class="control-label"><strong>Nepali Name</strong></label>
			<div class="controls">
				 {{ Form::text('name_nepali', null, array('class'=>'input-xxlarge', 'placeholder'=>'')) }}				
			</div>
		</div>	
	
		<div class="control-group">
							<label for="textfield" class="control-label"><strong>Select Category</strong></label>
							<div class="controls">
	{{ Form::select('category_id', $categories , '', array('id'=> 'sd','class' => 'input-large')) }}											
							</div>
						</div>	
	
			
	
		<!--<div class="control-group">
													<label for="textfield" class="control-label"><strong>Upload Image</strong></label>
													<div class="controls">
														<div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
															<div>
																<span class="btn btn-file"><span class="fileupload-new">Select Photo</span><span class="fileupload-exists">Change</span><input type="file" name='photo' /></span>
																<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
														</div>
													</div>
		</div>-->	
																																									
																																																						
<div class="control-group">
	<label for="textarea" class="control-label"><strong>Description:</strong></label>
	<div class="controls">
	{{ Form::textarea('description', null, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}													
	</div>
</div>	

<div class="control-group">
			<label for="textarea" class="control-label"><strong>Description in Nepali:</strong></label>
			<div class="controls">
			{{ Form::textarea('description_nepali', null, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}																
			</div>
		</div>	
			
		<div class="control-group">
			<label for="select" class="control-label"><strong>Status</strong></label>
			<div class="controls">
				{{ Form::select('is_active', array('1' => 'Yes', '0' => 'No'), '1');}}												
			</div>
		</div>			
				
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save changes</button>
			<a href="{{ Request::root() }}/admin/books" class="btn">Cancel</a>
		</div>
{{ Form::close() }}
</div>
										</div>
									</div>										
									</div>
									
									@include('admin.books.uploads.book_documents')									
									@include('admin.books.uploads.manage_meta_tags')			
								</div>
							</div>
						</div>
				</div>
				
</div>