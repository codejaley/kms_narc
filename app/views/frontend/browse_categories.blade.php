<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb main_breadcrumbs">
                    <li><a href="{{ Request::root() }}">Home</a></li>
                    <li class="active">Category </li>
                </ol>
            </div>
            <div class="col-md-8">
					<h2>
                        <div class="row">
                            <div class="col-md-2">
                            <?php if ($category[0]->photo != '') { ?>
                                <img src="{{Request::root()}}/category_covers/cover_{{$category[0]->photo}}" class="img-circle category-cover">
                            <?php } ?>
                            </div>
                            <div class="col-md-9">
                            	<h4>Browse Category</h4>{{ $category[0]->name }}
                            </div>
                        </div>
                    </h2>
				
                
<?php if ($books->count() > 0) { ?>			
<div class="row table_item_listing">
	<div data-example-id="panel-without-body-with-table" class="bs-example">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Listed Items</div>
			<table id="datatable" class="table">
				<thead>
				<tr>
                	<th>Cover</th>
					<th>Title</th>
					<th>Published Date</th>									
				</tr>
				</thead>
				<tbody>
				<?php foreach($books as $book) { ?>
						<tr>
                        	<td>
                            	<?php if ($book->photo != '') { ?>
								<img src="{{Request::root()}}/covers/cover_{{$book->photo}}"  class="list-image-height"><br>
								<?php } ?>
                            </td>
                            <td>
								
								<a href="{{ Request::root() }}/item/details/{{ $book->slug }}">{{ $book->name }}</a>
							</td>
							<td>

								<?php
								if ($book->date_format == 'year') {
									echo date('Y', strtotime($book->published_date));
								} else if($book->date_format == 'year_month') {
									echo date('F, Y', strtotime($book->published_date));
								} else {
									echo $book->published_date;
								}
								?>
							</td>
							
						</tr>
				<?php } ?>		
				</tbody>
			</table>

		</div>
	</div>
</div>			
<?php } ?>			
			
			<div class="row catgory_listing">
				<?php if (count($categories) > 0) { ?>
					<ul>
					<?php foreach ($categories as $category) { ?>
						@include('partials.front-category', $category)
					<?php }  ?>
					</ul>
				<?php  } else {?>
					<div class="alert alert-info">
								<i class="fa fa-ban"></i>
								<b>No Subcategory found</b>
							</div>		
					<div class="form-group">
							<label>Back To </label>
							<select id="advance_option" class="selectpicker show-menu-arrow form-control" multiple data-max-options="1">
								<option value="1">Home</option>
								<option value="5">All Categories</option>
								<option value="2">Advanced Search</option>
								<option value="3">Published Date</option>
								<option value="4">Authors</option>
							</select>
					</div>										
				<?php } ?>	
			</div>
			
            </div>
             @include('frontend.includes.new_inner_pages_sidebar')	
        </div>
    </div>
</section>
<script>
	$('#advance_option').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		if (optionSelected.val() == 1) {
			location.href='{{ Request::root() }}';
		} else if(optionSelected.val() == 2) {
			location.href='{{ Request::root() }}/search/advance';
		} else if(optionSelected.val() == 3) {
			location.href='{{ Request::root() }}/items/browse/date';
		} else if(optionSelected.val() == 4) {
			location.href='{{ Request::root() }}/browse/authors';
		} else if(optionSelected.val() == 5) {
			location.href='{{ Request::root() }}/all/categories';
		}
	});	
</script>