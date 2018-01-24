<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Search our knowledgebase</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}/admin">Home</a></li>
                        <li class="active">Search Result </li>
                    </ol>
                </div>



                <div class="blog-post">
                    <div class="form_group">
                        <label>Search for </label>
                        <form action="{{ Request::root() }}/search" method="post" name="search_frm">
                            <div class="form-group">
                                <input type="text" placeholder="Search keyword" id="exampleInputEmail1" name="search_box" value="{{ $search_key }}" class="form-control">
                            </div>
                            <input type="submit" id="btn_submit" value="Search" name="btn_submit" class="btn btn-default custom-button">
                        </form>
                    </div>
                </div>



                <div class="row table_item_listing">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Listed Items</div>
                            <table id="search_result" class="table">
                                <thead>
                                <tr>
                                	<th>Cover</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach($results as $result) { ?>
									<tr>
										<td>
                                         <?php if ($result->photo != '') { ?>
                                                 <a href="{{ Request::root() }}/item/details/{{ $result->slug }}"><img src="{{Request::root()}}/covers/cover_{{$result->photo}}" class="list-image-height"></a>
                                            <?php } ?>

                                        </td>
                                         <td>

                                            <a href="{{ Request::root() }}/item/details/{{ $result->slug }}">{{ $result->name }}</a></td>
										<td>{{ $result->category }}</td>
										<td>
                                            <?php
                                            if ($result->date_format == 'year') {
                                                echo date('Y', strtotime($result->published_date));
                                            } else if($result->date_format == 'year_month') {
                                                echo date('F, Y', strtotime($result->published_date));
                                            } else {
                                                echo $result->published_date;
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
    $('#search_result').DataTable( {
		"pageLength": 20,
		"bSort": true,
		"aaSorting": [],
		"order": [[ 1, "desc" ]],
		/*"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] } ],*/
		"oLanguage": {
				"sSearch": "Quick Filter: "
			}
    } );
} );
</script>