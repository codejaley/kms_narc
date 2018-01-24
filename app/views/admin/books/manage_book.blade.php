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
<?php
	$book_url = (Auth::user()->role_id == 3)?'admin/your_items' : 'admin/books';
?>				
				<div class="row-fluid">					
						<div class="box-title">
							<nav align="right">
								<ul style="padding-top:10px">
								   <li style="list-style:none">
								   <a href="{{ Request::root() }}/{{ $book_url }}" class="btn btn-primary">Items</a>
								   </li>
								</ul>
							</nav>						
						</div>
						<div class="box box-color">
							<div class="box-title">
								<h3>
									<i class="icon-reorder"></i>
									Manage Item
								</h3>
								<ul class="tabs">
									<li class="<?php if (Input::get('tab') == 1 || !Input::get('tab')) echo 'active';?>">
										<a href="#t1" data-toggle="tab">Item Info</a>
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
										<h4>Edit Book Info</h4>
									<div class="span12">
										<div class="box">

<div class="box-content">
{{ Form::model($book, array('method' => 'PATCH', 'route' => array('admin.books.update', $book->id),'files' => true)) }}	
<div class="control-group">
			<label for="textfield" class="control-label"><strong>Book Name</strong></label>
			<div class="controls">
				 {{ Form::text('name', null, array('class'=>'input-xxlarge', 'placeholder'=>'','style' => 'width:1000px')) }}				
			</div>
		</div>
	
		<div class="control-group">
			<label for="textfield" class="control-label"><strong>Nepali Name</strong></label>
			<div class="controls">
				 {{ Form::text('name_nepali', null, array('class'=>'input-xxlarge', 'placeholder'=>'','style' => 'width:1000px')) }}				
			</div>
		</div>	
	
		<div class="control-group">
							<label for="textfield" class="control-label"><strong>Select Category</strong></label>
							<div class="controls">
	{{ Form::select('category_id', $categories , $book->category_id, array('id'=> 'select_cat','class' => 'input-large chosen-select')) }}
							</div>
		</div>

	<div class="control-group">
		<label for="textfield" class="control-label"><strong>Select Publisher</strong></label>
		<div class="controls">
			{{ Form::select('publisher_id', $publishers , $book->publisher_id, array('id'=> 'select_publisher','class' => 'input-large chosen-select')) }}
		</div>
	</div>


	<div class="control-group">

		<div>
			<?php if ($book->photo != '') {?>
			{{ HTML::image(Request::root().'/covers/cover_'.$book->photo, '', array('width'=>'300'))}}

				<a href="{{Request::root()}}/admin/books/remove_photo/{{$book->id}}" onclick="return window.confirm('Are you sure?')" class="btn btn-danger">Remove Photo</a>
			<?php } ?>
		</div>

		<label for="textfield" class="control-label"></label>
		<div class="controls">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
				<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>



				<div>
					<span class="btn btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span><input type="file" name='photo' /></span>
					<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
				</div>
			</div>
		</div>
	</div>

	<div class="control-group">
							<label for="textfield" class="control-label"><strong>Select Author(s)</strong></label>
							<div class="controls">
								<?php
								echo Form::select('author_id[]', $authors, $selected_author, array('multiple' => 'multiple' ,'class' => 'chosen-select','id' => 'my-select3'));
								?>
							</div>
	   </div>	
	   
	<div class="control-group">
			<label for="password" class="control-label"><strong>Published Date</strong></label>
			<div class="controls">
				{{ Form::text('published_date', $book->published_date, array('class'=>'input-medium datepick', 'placeholder'=>'')) }}			
			</div>
		</div>

	<div class="control-group">
		<label for="select" class="control-label"><strong>Date Format</strong></label>
		<div class="controls">
			{{ Form::select('date_format', array('' => 'Select','year' => 'Year Only', 'year_month' => 'Year and Month', 'full_date' => 'Full Date'), $book->date_format);}}
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
			<a href="{{ Request::root() }}/{{ $book_url }}" class="btn">Cancel</a>
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

