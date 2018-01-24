<link rel="stylesheet" href="/admin_root/css/plugins/datepicker/datepicker.css">
<link rel="stylesheet" href="/admin_root/css/plugins/multiselect/multi-select.css">
<script src="/admin_root/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin_root/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>

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
									Manage Project
								</h3>
								<ul class="tabs">
									<li class="<?php if (Input::get('tab') == 1 || !Input::get('tab')) echo 'active';?>">
										<a href="#t1" data-toggle="tab">Project Sheet</a>
									</li>
									<li class="<?php if (Input::get('tab') == 2) echo 'active';?>">
										<a href="#t2" data-toggle="tab">Project Reports</a>
									</li>
									<li class="<?php if (Input::get('tab') == 3) echo 'active';?>">
										<a href="#t3" data-toggle="tab">Project Presentations</a>
									</li>
									<li class="<?php if (Input::get('tab') ==4) echo 'active';?>">
										<a href="#t4" data-toggle="tab">Project Briefs</a>
									</li>
									<li class="<?php if (Input::get('tab') == 5) echo 'active';?>">
										<a href="#t5" data-toggle="tab">Discussion Papers</a>
									</li>
									<li class="<?php if (Input::get('tab') == 6) echo 'active';?>">
										<a href="#t6" data-toggle="tab">Training Materials</a>
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
{{ Form::model($project, array('method' => 'PATCH', 'route' => array('admin.projects.update', $project->id),'files' => true)) }}	
		<div class="control-group">
			<label for="textfield" class="control-label"><strong>Project Title</strong></label>
			<div class="controls">
				 {{ Form::text('title', $project->title, array('class'=>'input-xxlarge', 'placeholder'=>'')) }}
				
			</div>
		</div>
		
		<div class="control-group">
							<label for="textfield" class="control-label"><strong>Select Country</strong></label>
							<div class="controls">
								<?php
								echo Form::select('country_id[]', $country_lists, $selected_country, array('multiple' => true ,'class' => 'multiselect','id' => 'my-select'));
								?>
							</div>
		</div>	
	
	
		<div class="control-group">
									<label for="textfield" class="control-label"><strong>Select Client(s)</strong></label>
									<div class="controls">
										<?php
										echo Form::select('client_id[]', $client_lists, $selected_client, array('multiple' => true ,'class' => 'multiselect','id' => 'my-select'));
										?>
									</div>
				</div>	
		
		<div>
				<?php if ($project->photo != '') {?>									 
					{{ HTML::image(Request::root().'/project_images/th_'.$project->photo, '', array('width'=>'100'))}}							 	
				 <?php } ?>															
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
				{{ Form::text('start_date', $project->start_date, array('class'=>'input-medium datepick', 'placeholder'=>'')) }}			
			</div>
		</div>													
		
		<div class="control-group">
			<label for="password" class="control-label"><strong>End Date</strong></label>
			<div class="controls">
				{{ Form::text('end_date', $project->end_date, array('class'=>'input-medium datepick', 'placeholder'=>'')) }}			
			</div>
		</div>																																																
											
		
<div class="control-group">
	<label for="textarea" class="control-label"><strong>Narrative description of Project</strong></label>
	<div class="controls">
	{{ Form::textarea('description', $project->description, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}														
	</div>
</div>	

		<div class="control-group">
			<label for="textarea" class="control-label"><strong>Description of actual services provided in the assignment</strong></label>
			<div class="controls">
			{{ Form::textarea('service_desription', $project->service_desription, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}																
			</div>
		</div>	
		
									<div class="control-group">
										<label for="select" class="control-label"><strong>Status</strong></label>
										<div class="controls">
											{{ Form::select('is_active', array('1' => 'Yes', '0' => 'No'), $project->is_active);}}												
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
									
									@include('admin.projects.uploads.project_reports')
									
									@include('admin.projects.uploads.project_presentations')
									
									@include('admin.projects.uploads.project_briefs')	
									
									@include('admin.projects.uploads.discussion_papers')																
																	
									@include('admin.projects.uploads.training_materials')	
									
								</div>
							</div>
						</div>
				</div>
				
</div>