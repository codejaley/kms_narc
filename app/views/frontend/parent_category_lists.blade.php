<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>{{ Config::get('front-constants.ALL_CATEGORIES_CAPTION') }}</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">{{ Config::get('front-constants.HOME_CAPTION') }}</a></li>
                        <li class="active">{{ Config::get('front-constants.ALL_CATEGORIES') }}</li>
                    </ol>
                    <img src="{{Request::root()}}/images/hill-farming.jpg">
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
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach($categories as $category) { ?>
										<tr>
											<td>
												<a href="{{ Request::root() }}/browse/category/{{ $category->slug }}">{{ $category->name }}</a>
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
        "order": [[ 0, "asc" ]],
		"pageLength": 20,
		"oLanguage": {
				"sSearch": "Quick Search: "
			}
    } );
} );
</script>