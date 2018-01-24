<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Browse Our Repositories</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li class="active">Author Listings</li>
                    </ol>
                </div>



                

<div class="pagination_bar">
    <ul class="pagination">
        <p>Filter Author</p>
        <?php foreach($alphabets as $alphabet) {
			if (Input::get('char') == strtolower($alphabet)) {
				$status = 'active';
			} else {
				$status = '';
			}
		?>
			<li class="{{ $status }}"><a href="{{ Request::root() }}/browse/authors?char={{ strtolower($alphabet) }}">{{ $alphabet }}</a></li>
    	<?php } ?>
	</ul>
</div>

                <div class="row table_item_listing author_browse">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Author Listing</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Authors</th>
                                    <th>Publications</th>

                                </tr>
                                </thead>
                                <tbody>
								<?php foreach($authors as $author) {?>
									<tr>
										<td><a href="{{ Request::root() }}/browse/author/{{ $author->user_id }}">{{ $author->firstname }} {{ $author->lastname }}</a></td>
										<td><span>{{ $author->total_books }}</span></td>	
									</tr>
								<?php } ?>	
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

















            </div>
            <div class="col-md-4"> <h2>Browse By Author</h2>



                <ul class="browse_repo">
                    <li class="col-md-12 col-sm-6"><a href="#">M.N Paudel (2)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">J D Ranjit (1)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">S Sharma (1)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">D D Gautam (1)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">J Tripathi (1)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Ram B bhujel (0)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Resham B Thapa (0)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Tara B Ghimire (0)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Mahesh K Adhikaru (0)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Bal K Joshi (0)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Madan R Bhatta (0)</a></li>
                    <li class="col-md-12 col-sm-6"><a href="#">Hira K Manandhar (0)</a></li>
                </ul>

                <div class="form-group">



                    <select id="maxOption21" class="selectpicker show-menu-arrow form-control" multiple data-max-options="1">
                        <option>Alphabetically</option>
                        <option>Most Popular</option>
                        <option>Most Uploaded</option>
                    </select>

                </div>
            </div>
        </div>
    </div>



</section>