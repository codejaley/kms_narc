<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Change Password</h1>
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
								<h3><i class="icon-edit"></i>Change Password</h3>
							</div>
							<div class="box-content">
							<form method='POST' action="{{Request::root()}}/admin/users/reset_password" enctype="multipart/form-data" class="form-horizontal">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											{{ $user->username }}
											
										</div>
									</div>									
									{{ Form::hidden('id', $user->id) }}
									<div class="control-group">
										<label for="textfield" class="control-label">New Password</label>
										<div class="controls">
											  {{ Form::password('password', array('placeholder'=>'', 'class'=>'input-xlarge' ) ) }}									
											
										</div>
									</div>
																	
									<div class="control-group">
										<label for="textfield" class="control-label">Confirm Password</label>
										<div class="controls">
											 {{ Form::password('password_confirmation', array('placeholder'=>'', 'class'=>'input-xlarge' ) ) }}
										</div>
									</div>																
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<a href="{{ Request::root() }}/admin/users" class="btn">Cancel</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>