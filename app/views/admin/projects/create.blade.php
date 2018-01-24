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
						<h1>{{ Config::get('admin-field-constants.PROJECT_PAGE_TITLE') }}</h1>
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
										   <a href="{{ Request::root() }}/admin/projects" class="btn btn-primary">Projects</a>
										   </li>
										</ul>
									</nav>								
							</div>						
						
						<div class="box box-color">
							<div class="box-title">
								<h3>
									<i class="icon-reorder"></i>
									Add new project
								</h3>
																	
								<ul class="tabs">
									<li class="active">
										<a href="#t1" data-toggle="tab">Project Sheet</a>
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
										<h4>Add Project Sheet</h4>
									<div class="span12">
										<div class="box">

<div class="box-content">
	{{ Form::open(array('route' => 'admin.projects.store', 'files' => true, 'class'=>'form-vertical')) }}
		<div class="control-group">
			<label for="textfield" class="control-label"><strong>Project Title</strong></label>
			<div class="controls">
				 {{ Form::text('title', null, array('class'=>'input-xxlarge', 'placeholder'=>'')) }}				
			</div>
		</div>
	
	
	
		<div class="control-group">
							<label for="textfield" class="control-label"><strong>Select Country</strong></label>
							<div class="controls">
								<?php
								echo Form::select('country_id[]', $country_lists, '', array('multiple' => true ,'class' => 'multiselect','id' => 'my-select'));
								?>
							</div>
	   </div>	
	
	<div class="control-group">
			<label for="password" class="control-label"><strong>Client</strong></label>
			<div class="controls">
				<?php
								echo Form::select('client_id[]', $client_lists, '', array('multiple' => true ,'class' => 'multiselect','id' => 'my-select2'));
								?>												
			</div>
		</div>		
	
		<div class="control-group">
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
		</div>	
																																									

	<div class="control-group">
			<label for="password" class="control-label"><strong>Start Date</strong></label>
			<div class="controls">
				{{ Form::text('start_date', null, array('class'=>'input-medium datepick', 'placeholder'=>'')) }}			
			</div>
		</div>													
		
		<div class="control-group">
			<label for="password" class="control-label"><strong>End Date</strong></label>
			<div class="controls">
				{{ Form::text('end_date', null, array('class'=>'input-medium datepick', 'placeholder'=>'')) }}			
			</div>
		</div>													
																																												
<div class="control-group">
	<label for="textarea" class="control-label"><strong>Narrative description of Project:</strong></label>
	<div class="controls">
	{{ Form::textarea('description', null, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}													
	</div>
</div>	

<div class="control-group">
			<label for="textarea" class="control-label"><strong>Description of actual services provided in the assignment:</strong></label>
			<div class="controls">
			{{ Form::textarea('service_desription', null, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}																
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
			<a href="{{ Request::root() }}/admin/projects" class="btn">Cancel</a>
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