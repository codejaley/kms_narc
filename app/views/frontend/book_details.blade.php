<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8">
					<div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">{{ Config::get('front-constants.HOME_CAPTION') }}</a></li>
                        <li class="active">Items Details</li>
                    </ol>
                </div>
                <div class="row table_item_listing ">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Item Details</div>
                            <table class="table">
                                <tbody>
								<?php if ($book[0]->photo != '') {?>								
                                 <tr>
									<td><img src="{{ Request::root() . '/covers/cover_' . $book[0]->photo }}" title="{{$book[0]->name}}" class="img-circle book-cover"></td>
                                   
                                    	
                                        	<td>
                                            	<h4>{{ $book[0]->name }}</h4><br />
                                            	<p>
													<h5><b>Author(s):</b></h5>
													<?php foreach($authors as $author) { 
													echo "<a href='". Request::root() . '/browse/author/' . $author->user_id ."'>" . $author->OrmUser->firstname . "</a>" . '<br>';
//echo $author->OrmUser->firstname . '<br>';													
												}
										?>  
                                        		</p>
                                                <p>
                                                	<?php if ($book[0]->published_date != '') {?>
                                                	<h5><b>Published Date :</b></h5>
                                                    <?php
														if ($book[0]->date_format == 'year') {
															echo date('Y', strtotime($book[0]->published_date));
														} else if($book[0]->date_format == 'year_month') {
															echo date('F, Y', strtotime($book[0]->published_date));
														} else {
															echo $book[0]->published_date;
														}
														?>
                                                </p>
                                                <?php } ?>
												<?php if($book[0]->publisher_id != '') {?>
													<p>
														<h5><b>Publisher :</b></h5>
														{{$book[0]->OrmPublisher->name}}
													</p>
												<?php } ?>

                                            </td>
                                    
								</tr>
								<?php } ?>
                                
                                <tr>
                                    <th  >Abstract (English)</th>
                                    <td>
									{{ $book[0]->description }}
                                    </td>
                                </tr>
								<?php if ($book[0]->description_nepali != '') {?>
									<tr>
										<th  >Abstract (Nepali)</th>
										<td>{{ $book[0]->description_nepali }}</td>
									</tr>
								<?php } ?>	
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



				<?php 
				if ($total_document > 0) { ?>
					<div class="col-md-12">
						<h3>Documents</h3>
	
						<div data-example-id="panel-without-body-with-table" class="bs-example">
							<div class="panel panel-default">
								<!-- Default panel contents -->
								<div class="panel-heading">Listed Items</div>
								<table class="table">
									<thead>
									<tr>
										<!--<th>Title</th>-->
										<th>File</th>
										<th>View/Download</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($books as $entry) { ?>
										<tr>
											<?php /*?><td>{{ $entry->OrmDocument[0]->title }}</td><?php */?>
											<td>{{ $entry->OrmDocument[0]->name }}</td>
											<td><a href="{{ Request::root() }}/dms_books/{{ $entry->OrmDocument[0]->name  }}" target="_blank">Click Here</a></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
            	<?php } else {?>
					<div class="alert alert-info">
								<i class="fa fa-ban"></i>
								<b>No Document found</b>
							</div>						
				<?php } ?>
			</div>
             @include('frontend.includes.new_inner_pages_sidebar')	
        </div>
    </div>



</section>
<script>
function goBack() {
    window.history.back();
}
</script>