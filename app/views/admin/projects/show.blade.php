<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Project Details</h1>
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
							
							<div class="box-content">
								{{ Form::open(array('route' => 'admin.blogs.store', 'files' => true,'class' => 'form-vertical')) }}
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Project Title</h4></label>
										<div class="controls">
											 {{ $project->title; }}
											
										</div>
									</div>
									
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Country(s)</h4></label>
											<div class="controls">
												<?php foreach($countries as $key=>$country) {
														echo $country['orm_country']['name'] . '<br>';
												}
												?>
											</div>
								</div>									
									
															
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Client</h4></label>
											<div class="controls">
												<?php foreach($clients as $key=>$client) {
														echo $client['orm_client']['name'] . '<br>';
												}
												?>												
											</div>
								</div>										
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Start Date</h4></label>
											<div class="controls">
												{{ $project->start_date }}
											</div>
								</div>									
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>End Date</h4></label>
											<div class="controls">
												<?php if ($project->end_date != '') { 
															echo $project->end_date;
														} else {
															echo "Running Project";
														}
												?>
											</div>
								</div>								
																						
							
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Narrative description of Project</h4></label>
											<div class="controls">
												{{ $project->description }}
											</div>
								</div>									
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Description of actual services provided in the assignment</h4></label>
											<div class="controls">
												{{ $project->service_desription }}
											</div>
								</div>								
																								
									<div class="form-actions">
										<a href="{{ Request::root() }}/admin/projects" class="btn btn-primary">Back</a>
									</div>								
																																	
								
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>