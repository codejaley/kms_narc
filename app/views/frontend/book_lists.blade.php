<section>
  <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Item Listings</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">{{ Config::get('front-constants.HOME_CAPTION') }}</a></li>
                        <li><a href="{{ Request::root() }}/all/categories">{{ Config::get('front-constants.ALL_CATEGORIES') }}</a></li>
						<li class="active">Category :: {{ $category[0]->name }}</li>
                    </ol>
                </div>

                <div class="row table_item_listing">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Listed Items</div>
                            <table id="datatable" class="table">
                                <thead>
                                <tr>
                                    <th>Published Date</th>
									<th>Title</th>									
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach($books as $book) { ?>
										<tr>
											<td>{{ $book->published_date }}</td>
											<td>
												<a href="{{ Request::root() }}/item/details/{{ $book->slug }}">{{ $book->name }}</a>
											</td>
										</tr>
								<?php } ?>		
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
            @include('frontend.includes.new_inner_pages_sidebar')	
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $('#datatable').DataTable( {
		"pageLength": 20,
		"bSort": true,
		"aaSorting": [],
		"order": [[ 0, "asc" ]],
		/*"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] } ],*/
		"oLanguage": {
				"sSearch": "Quick Search: "
			}
    } );
} );
</script>