<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Browse Our Repositories</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">Home</a></li>
                        <li class="active">Author :: {{ $author[0]->firstname}} {{ $author[0]->lastname}}</li>
                    </ol>
                </div>


				<?php if ($author[0]->bio != '') {?>
					<div class="blog-post">
						<div class="form_group">
							<label>Author Introduction </label>
							<p style="color:#fff">{{ $author[0]->bio }}</p>
						</div>
					</div>
				<?php } ?>


                <div class="row table_item_listing">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
							<div class="panel panel-default">
								<!-- Default panel contents -->
								<div class="panel-heading">Listed Items</div>
								<table class="table" id="datatable">
									<thead>
									<tr>
										<th>Title</th>
										<th>Published Date</th>
									</tr>
									</thead>
									<tbody>
									<?php 								
									if (count($books) > 0) { 
										foreach($books as $book) { ?>
											<tr>
												<td><a href="{{ Request::root() }}/item/details/{{ $book->OrmBook->slug }}">{{ $book->OrmBook->name }}</a></td>
												<td>{{ $book->OrmBook->published_date }}</td>
											</tr>
										<?php } 
										}
										?>
	
									</tbody>
								</table>
	
							</div>
                    </div>
                </div>


            </div>
		@include('frontend.includes.inner_pages_sidebar')	
        </div>
    </div>

</section>
<script>
$(document).ready(function() {
    $('#datatable').DataTable( {
		"pageLength": 20,
		"bSort": true,
		"aaSorting": [],
		"order": [[ 1, "desc" ]],
		/*"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] } ],*/
		"oLanguage": {
				"sSearch": "Quick Search: "
			}
    } );
} );
</script>