<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Service Settings</h1>
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
								<h3><i class="icon-edit"></i> Service Landing Page</h3>
							</div>
							<div class="box-content">
								<form name="client_photo" method='POST' action="{{Request::root()}}/admin/service_settings_save" class="form-vertical" enctype="multipart/form-data">	
																									
								
								<div class="control-group">

											<label for="textfield" class="control-label"><h5>Service page intro text</h5></label>
											<div class="controls">
												{{ Form::textarea('service_intro_text', $service_intro_text[0]->value, array('class'=>'ckeditor','style' => 'width:1000px;height:80px', 'size' => '30x3')) }}
											</div>
								</div>									
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h5>ACI quote</h5></label>
											<div class="controls">
												{{ Form::textarea('service_sidebar_text', $service_sidebar_text[0]->value, array('class'=>'ckeditor','style' => 'width:1000px;height:80px', 'size' => '30x3')) }}
											</div>
								</div>														

						
								<div class="control-group">
											<label for="textfield" class="control-label"><h5>Client quote</h5></label>
											<div class="controls">
												{{ Form::textarea('service_client_quote', $service_client_quote[0]->value, array('class'=>'ckeditor','style' => 'width:1000px;height:80px', 'size' => '30x3')) }}
											</div>
								</div>							
						
									<div class="control-group">
										
											<label for="textfield" class="control-label"><h5>Select Picture</h5></label>
											
											<div class="controls">
												
									<?php 
										if ($service_page_photo[0]->value != '') {
									?>
										<img src="{{ Request::root() }}/assets/th_{{ $service_page_photo[0]->value }}" /><br />
									<?php } ?>													
												
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
														<span class="btn btn-file"><span class="fileupload-new">Select Photo</span><span class="fileupload-exists">Change</span><input type="file" name='service_page_photo' /></span>
														<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
													</div>
												</div>
											</div>
										</div>						
															
						<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<a href="{{ Request::root() }}/admin" class="btn">Cancel</a>
									</div>
								</form>
							</div>
						</div>

						
					</div>
				</div>				
				<!-- main container ends -->
				
</div>