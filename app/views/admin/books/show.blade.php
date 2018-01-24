<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Item Details</h1>
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
										<label for="textfield" class="control-label"><h4>Book Title</h4></label>
										<div class="controls">
											 {{ $book->name; }}
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Book Title(Nepali)</h4></label>
										<div class="controls">
											 {{ $book->name_nepali; }}
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Book Description</h4></label>
										<div class="controls">
											 {{ $book->description; }}
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Book Description(Nepali)</h4></label>
										<div class="controls">
											 {{ $book->description_nepali; }}
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Book Category</h4></label>
										<div class="controls">
											 {{ $book->OrmCategory->name; }}
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label"><h4>Book Submitted by</h4></label>
										<div class="controls">
											 {{ $book->OrmUser->firstname . ' ' .  $book->OrmUser->lastname; }}
											
										</div>
									</div>
											
<?php
	$book_url = (Auth::user()->role_id == 3)?'admin/your_items' : 'admin/books';
?>																									
									<div class="form-actions">
										<a href="{{ Request::root() }}/{{ $book_url }}" class="btn btn-primary">Back</a>
									</div>								
																																	
								
							</div>
						</div>
					</div>
				</div>				
				<!-- main container ends -->
				
</div>