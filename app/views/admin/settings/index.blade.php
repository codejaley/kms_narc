<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Constants</h1>
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
								<h3><i class="icon-edit"></i> Manage Settings</h3>
							</div>
							<div class="box-content">
								<form name="client_photo" method='POST' action="{{Request::root()}}/admin/settings/save_constants" class="form-vertical" enctype="multipart/form-data">	
								
							
							<?php foreach($constants as $constant) { ?>
							<input type="hidden" name="hidden_vals[]" value="{{ $constant->title }}">
<div class="row">								
<div class="span6">
								<h3>{{ $constant->title_hidden }}<h3>
										<div class="control-group">
											
											<div class="controls">
		{{ Form::textarea('content_english[]', $constant->content_english, array('style' => 'width:1000px;height:80px', 'size' => '30x3')) }}
		
											</div>
										</div>
										
										
										
									</div>								
								
								
						</div>		
							
							<?php } ?>		
						
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Save changes</button>
											<button type="button" class="btn">Cancel</button>
										</div>
									</div>						
								</form>
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>