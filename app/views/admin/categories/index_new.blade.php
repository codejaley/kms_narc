<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Book Categories</h1>
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
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Category Listings
								</h3>
								<div>
									&nbsp;&nbsp;Filter By Category
									{{ Form::open(array('url' => 'admin/categories')) }}
										{{ Form::select('category_id',$list_categories,$category_id,array('class' => 'form-control')) }}
									{{ Form::close() }}
								</div>
										
								<nav align="right">
										<ul>
										   <li>
										   <a href="{{ Request::root() }}/admin/categories/create" class="btn btn-primary">Add new</a>
										   </li>
										</ul>
									</nav>								
							</div>
							<div class="box-content nopadding">
								<table class="table table-responsive table-bordered">
										<thead>
										  <tr>
											<th>Category Name</th>
										  </tr>
										</thead>
										<tbody>
										  @foreach($categories as $entry)
											 <?php foreach ($categories as $entry) { ?>
        											@include('admin.partials.category', $entry)
    										<?php }  ?>
										  @endforeach 
										</tbody>
									  </table>								
							</div>
						</div>
					</div>
				
				</div>				
				
</div>