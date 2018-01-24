<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Nature of Publication : {{$publication->name}}</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">Home</a></li>
                    </ol>
                </div>


                <div class="row table_item_listing">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Listed Category for Nature of Publication : <strong>{{$publication->name}}</strong></div>
                            <table id="datatable" class="table">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach($results as $result) { ?>
									<tr>
										<td>
                                         <?php if ($result->photo != '') { ?>
                                                <img src="{{Request::root()}}/category_covers/cover_{{$result->photo}}"><br>
                                         <?php } ?>
                                            <a href="{{ Request::root() }}/browse/category/{{ $result->slug }}">{{ $result->name }}</a></td>
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
		"order": [[ 0, "asc" ]],
		/*"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] } ],*/
		"oLanguage": {
				"sSearch": "Quick Filter: "
			}
    } );
} );
</script>