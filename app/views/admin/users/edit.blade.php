<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Users</h1>
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
								<h3><i class="icon-edit"></i> Edit user</h3>
							</div>
							<div class="box-content">
								{{ Form::model($user, array('method' => 'PATCH', 'route' => array('admin.users.update', $user->id),'files' => true)) }}	
									<div class="control-group">
										<label for="textfield" class="control-label">First Name</label>
										<div class="controls">
											 {{ Form::text('firstname', null, array('class'=>'input-xlarge', 'placeholder'=>'')) }}
											
										</div>
									</div>
															
															
								<div class="control-group">
										<label for="textfield" class="control-label">Email</label>
										<div class="controls">
											 {{ Form::text('email', null, array('class'=>'input-xlarge', 'placeholder'=>'')) }}
											
										</div>
								</div>								
																	
								
						<label for="textarea" class="control-label"><strong>Bio:</strong></label>
							<div class="controls">
							{{ Form::textarea('bio', null, array('class'=>'ckeditor', 'size' => '50x6', 'placeholder'=>'')) }}													
							</div>
						</div>									
									
								<div class="control-group">
											<label for="textfield" class="control-label">Role</label>
											<div class="controls">
												{{ Form::select('role_id', $roles , '', array('id'=> 'abx','class' => 'input-large')) }}					
											</div>
										</div>																	
									<div class="control-group">
										<label for="select" class="control-label">Status</label>
										<div class="controls">
											{{ Form::select('is_active', array('1' => 'Yes', '0' => 'No'), $user->is_status);}}												
										</div>
									</div>									
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<a href="{{ Request::root() }}/admin/users" class="btn">Cancel</a>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
					
				</div>				
				<!-- main container ends -->
				
</div>