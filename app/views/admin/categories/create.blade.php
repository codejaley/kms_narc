<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Book Categories</h1>
					</div>
					
				</div>
				<!-- Breadcrumb starts	-->
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Home</a>
							<i class="icon-angle-right"></i>
						</li>
					</ul>					
				</div>
				<!-- Breadcrumb ends -->
				
				<!-- main container starts -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i> Add new book category</h3>
							</div>
							<div class="box-content">
								{{ Form::open(array('route' => 'admin.categories.store', 'files' => true,'class' => 'form-horizontal')) }}
									<div class="control-group">
										<label for="textfield" class="control-label">Name</label>
										<div class="controls">
											{{ Form::text('name', null, array('class'=>'input-xxlarge', 'style'=>'width:700px')) }}	
											
										</div>
									</div>																


									<div class="control-group">
										<label for="textfield" class="control-label">Nepali Caption</label>
										<div class="controls">
											{{ Form::text('name_nepali', null, array('class'=>'input-xxlarge', 'style'=>'width:700px')) }}	
											
										</div>
									</div>	

								<div class="control-group">
											<label for="textfield" class="control-label">Parent Category</label>
											<div class="controls">
												{{ Form::select('parent_id', $categories , '', array('id'=> 'choose_country','class' => 'chosen-select')) }}											
											</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Select Nature of publication</label>
									<div class="controls">
										{{ Form::select('publication_id', $publications , '', array('id'=> 'nature_publication','class' => 'chosen-select')) }}
									</div>
								</div>

								<div class="control-group">
									<label for="textfield" class="control-label">Select Subject</label>
									<div class="controls">
										{{ Form::select('subject_id', $subjects , '', array('id'=> 'subject','class' => 'chosen-select')) }}
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
										<label for="select" class="control-label">Status</label>
										<div class="controls">
											{{ Form::select('is_active', array('1' => 'Yes', '0' => 'No'), '1');}}												
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<a href="{{ Request::root() }}/admin/categories" class="btn">Cancel</a>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>