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
								<h3><i class="icon-edit"></i> Page</h3>
							</div>
							<div class="box-content">
								{{ Form::open(array('route' => 'admin.pages.store', 'files' => true,'class' => 'form-vertical')) }}
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Title</h4></label>
										<div class="controls">
											 {{ $page->title; }}
											
										</div>
									</div>
									
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Excerpt</h4></label>
											<div class="controls">
												{{ $page->intro_text; }}
											</div>
								</div>									
									
								
								<div class="control-group">
											<label for="textfield" class="control-label"><h4>Description</h4></label>
											<div class="controls">
												{{ $page->description; }}
											</div>
								</div>								
									
								<?php if ($page->photo != '') {?>			
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Image</h4></label>
										<div class="controls">
											{{ HTML::image(Request::root().'/blog/th_'.$page->photo, '', array('width'=>'200'))}}	
										</div>											
									</div>																		
								<?php } ?>
								
									<div class="form-actions">
										<a href="{{ Request::root() }}/admin/pages" class="btn btn-primary">Back</a>
									</div>								
																																	
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>