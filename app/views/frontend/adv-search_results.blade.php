<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
           <div class="col-md-8"><h2>Advance Search</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li class="active">Search Result </li>
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
								<?php foreach($results as $result) { ?>
									<tr>
										<td><a href="{{ Request::root() }}/item/details/{{ $result->slug }}">{{ $result->name }}</a></td>
										<td>{{ $result->category }}</td>
										<td>{{ $result->published_date }}</td>
									</tr>
								<?php } ?>	
                                </tbody>
                            </table>
							
							<?php if (count($results) == 0) { ?>
								<a class="btn btn-primary" href="{{ Request::root() }}/search/advance">Back to search</a>
							<?php } ?>
																
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
	$( "#btn_submit" ).click(function() {
		var search_text_length = $('#search_box').val().length;
	  	if(search_text_length > 2) {
			return true;	
		}		
		$('#search_box').focus();
		return false;
	});	
});
</script>
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