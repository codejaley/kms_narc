<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pages</h1>
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
								<h3><i class="icon-edit"></i> Add new page</h3>
							</div>
							<div class="box-content">
								{{ Form::open(array('route' => 'admin.pages.store', 'files' => true,'class' => 'form-vertical')) }}
									<div class="control-group">
										<label for="textfield" class="control-label">Title</label>
										<div class="controls">
											 {{ Form::text('title', null, array('class'=>'input-xxlarge', 'style'=>'width:1000px')) }}	
											
										</div>
									</div>
									
								<div class="control-group">
											<label for="textfield" class="control-label">Excerpt</label>
											<div class="controls">
												{{ Form::textarea('intro_text', null, array('style' => 'width:600px;height:200px', 'size' => '30x3')) }}
											</div>
								</div>									
									
								
								<div class="control-group">
											<label for="textfield" class="control-label">Description</label>
											<div class="controls">
												{{ Form::textarea('description', null, array('class'=>'ckeditor', 'size' => '30x6')) }}
											</div>
								</div>								
									
									
									<div class="control-group">
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
																		
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<a href="{{ Request::root() }}/admin/pages" class="btn">Cancel</a>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>