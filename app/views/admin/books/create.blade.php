<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/mockjax/jquery.mockjax.js"></script>
<script src="/admin_root/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="/admin_root/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="/admin_root/css/plugins/datepicker/datepicker.css">
<link rel="stylesheet" href="/admin_root/css/plugins/multiselect/multi-select.css">
<style>
	.ms-selected{
		display:block;
	}
</style>

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
										   <a href="{{ Request::root() }}/admin/books" class="btn btn-primary">Items</a>
										   </li>
										</ul>
									</nav>								
							</div>						
						
						<div class="box box-color">
							<div class="box-title">
								<h3>
									<i class="icon-reorder"></i>
									Add new item
								</h3>
																	
								<ul class="tabs">
									<li class="active">
										<a href="#t1" data-toggle="tab">Item Info</a>
									</li>
                                    <!--									<li>
										<a href="#" data-toggle="tab">Project Reports</a>
									</li>
									<li>
										<a href="#" data-toggle="tab">Project Briefs</a>
									</li>
									<li>
										<a href="#" data-toggle="tab">Discussion Papers</a>
									</li>
									<li>
										<a href="#" data-toggle="tab">Training Meterials</a>
									</li>-->																		
								</ul>
							</div>
							<div class="box-content">
								<div class="tab-content">
									<div class="tab-pane active" id="t1">
										<h4>Add Item Info</h4>
									    <div class="span12">
										<div class="box">

<div class="box-content">
	{{ Form::open(array('route' => 'admin.books.store', 'files' => true, 'class'=>'form-vertical')) }}
		<div class="control-group">
			<label for="textfield" class="control-label"><strong>Item Name</strong></label>
			<div class="controls">
				 {{ Form::text('name', null, array('class'=>'input-xxlarge', 'placeholder'=>'', 'style' => 'width:1000px')) }}				
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
			{{ Form::select('category_id', $categories , '', array('id'=> 'select_category','class' => 'chosen-select')) }}
							</div>
		</div>

	<div class="control-group">
		<label for="textfield" class="control-label"><strong>Select Publisher</strong></label>
		<div class="controls">
			{{ Form::select('publisher_id', $publishers , '', array('id'=> 'select_publisher','class' => 'chosen-select')) }}
		</div>
	</div>

	<div class="control-group">
		<label for="textfield" class="control-label"></label>
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
	</div>

	<div class="control-group">
							<label for="textfield" class="control-label"><strong>Select Author(s)</strong> <br />
							<a href="{{ Request::root() }}/admin/users/create" onclick="return window.confirm('Are you sure to add new user?');"> <i class="icon-edit"></i> Add New Author</a></label>
							
							<div class="controls">
								<?php
								echo Form::select('author_id[]', $authors, '', array('multiple' => 'multiple' ,'class' => 'chosen-select','id' => 'my-select'));
								?>
							</div>
	   </div>	
	   
	<div class="control-group">
			<label for="password" class="control-label"><strong>Published Date</strong></label>
			<div class="controls">
				{{ Form::text('published_date', null, array('class'=>'input-medium datepick', 'placeholder'=>'')) }}			
			</div>
		</div>


	<div class="control-group">
		<label for="select" class="control-label"><strong>Date Format</strong></label>
		<div class="controls">
			{{ Form::select('date_format', array('' => 'Select','year' => 'Year Only', 'year_month' => 'Year and Month', 'full_date' => 'Full Date'), '1');}}
		</div>
	</div>

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
<?php
	$cancel_url = (Auth::user()->role_id == 3)?'admin/your_books' : 'admin/books';
?>				
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save changes</button>
			<a href="{{ Request::root() }}/{{ $cancel_url }}" class="btn">Cancel</a>
		</div>
	{{ Form::close() }}
</div>
										</div>
									</div>										
									</div>
									<div class="tab-pane" id="t2">
										<h4>Project Reports</h4>
										Lorem ipsum ad proident amet anim voluptate ea. Lorem ipsum voluptate et ex esse mollit labore aliquip culpa dolore culpa anim cillum nulla ut sunt. Lorem ipsum veniam sunt voluptate elit minim incididunt occaecat aute ut ut sunt laboris. Lorem ipsum cupidatat labore elit sit in aliqua nostrud adipisicing minim et mollit sunt Ut cupidatat laboris. Lorem ipsum sunt ut labore nostrud ut aliqua dolor sint cupidatat sit Duis in culpa consectetur exercitation. Lorem ipsum sunt anim reprehenderit elit minim nulla ut. 
									</div>
									<div class="tab-pane" id="t3">
										<h4>Project Presentations</h4>
										Lorem ipsum commodo dolor sit in sint anim ad ut non et. Lorem ipsum cillum ex sunt ea irure Ut dolore in labore officia nostrud in anim culpa sit esse. Lorem ipsum elit Duis magna et voluptate Duis non pariatur esse laboris nisi laborum nulla. Lorem ipsum et tempor ea ad in id consectetur incididunt velit Excepteur officia. Lorem ipsum non consectetur Excepteur commodo aute anim sunt. Lorem ipsum pariatur esse nulla mollit Duis ex. Lorem ipsum cillum sit in ad consequat in ad enim incididunt ea laborum pariatur Excepteur aliqua nostrud ut. Lorem ipsum et magna laboris reprehenderit mollit reprehenderit aute Duis aliquip officia nulla. Lorem ipsum dolor Ut dolore in laborum elit dolore quis mollit ut sit Excepteur aute. Lorem ipsum quis et eiusmod in irure tempor ea labore cillum dolore labore eiusmod in occaecat qui ea. Lorem ipsum dolor fugiat deserunt incididunt eiusmod sunt magna reprehenderit sed enim ut cillum. Lorem ipsum irure pariatur exercitation sunt eiusmod dolore Ut do ut ut minim. Lorem ipsum do ea pariatur in anim deserunt Excepteur nisi culpa nisi aliquip culpa veniam ut non. 
									</div>
								</div>
							</div>
						</div>
				</div>
				
</div>