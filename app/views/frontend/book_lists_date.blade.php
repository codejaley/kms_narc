<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Items listings by Date</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li class="active">Item Listings </li>
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
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach($items as $item) { ?>
									<tr>
										<td><a href="{{ Request::root() }}/item/details/{{ $item->slug }}">
											{{ $item->name }}
										</a></td>
										<td><a href="{{ Request::root() }}/items/category/{{ $item->OrmCategory->slug }}">{{ $item->OrmCategory->name }}</a></td>
										<td>{{$item->published_date }}</td>
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
		"order": [[ 2, "desc" ]],
		/*"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] } ],*/
		"oLanguage": {
				"sSearch": "Quick Filter: "
			}
    } );
} );
</script>