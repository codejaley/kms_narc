<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Browse Our Knowledgebase</h2>
				<a href="{{ Request::root() }}/all/categories" class="btn btn-default custom-button">All Categories</a>
				<a href="{{ Request::root() }}/all/publications" class="btn btn-default custom-button">All Nature of Publication</a>
				<a href="{{ Request::root() }}/all/subjects" class="btn btn-default custom-button">All Subjects</a>
				<?php if(count($categories) > 0) {?>
					<ul class="browse_repo">
						<?php foreach ($categories as $category) { ?> 
							<li class="col-md-6 col-sm-6"><a href="{{ Request::root() }}/browse/category/{{ $category->slug }}">
								{{ $category->name }}
							</a></li>
						<?php } ?>
					</ul>
				<?php } ?>
				
				{{ $categories->links(); }}
				
                <?php /*?><ul class="pagination">
                    <li class="disabled"><span>�</span></li><li class="active"><span>1</span></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a rel="next" href="#">�</a></li>	
					</ul><?php */?>

            </div>

			<?php /* ?>
            <div class="col-md-4"> <h2>Browse By Author</h2>



                <ul class="browse_repo">
                    <?php foreach($authors as $author) { ?>
						<li class="col-md-12 col-sm-6">
							<a href="{{ Request::root() }}/browse/author/{{ $author->id }}">{{ $author->firstname }}({{ $author->total_books }})</a> 
						</li>
                	<?php } ?>
				</ul>

                <div class="form-group">



                    <select id="author_select" class="selectpicker show-menu-arrow form-control" multiple data-max-options="1">
					<option value="name">Name</option>
					<option value="most_visited">Most Visited</option>
                    </select>

                </div>
            </div>
			<?php */ ?>

<?php
	$publications 	= Publication::where('is_active', '=', '1')->take(5)->get();
	$subjects 		= Subject::where('is_active', '=', '1')->take(5)->get();
?>
			<div class="col-md-4">
				<h2>Browse By Nature Of Publication</h2>
				<img width="360" height="300" src="{{Request::root()}}/images/wheat.jpg">
				<ul class="browse_repo">
					<?php foreach($publications as $publication) {?>
							<li class="col-md-12 col-sm-6">
								<a href="{{Request::root()}}/browse/publication/{{$publication->id}}">
										{{$publication->name}}
								</a>
							</li>
					<?php } ?>
				</ul>

				<div class="form-group">
					<a href="{{Request::root()}}/all/publications" class="btn btn-primary">Show All</a>
				</div>

			</div>

			<div class="col-md-4">
				<h2>Browse By Subject</h2>
				<img width="360" height="300" src="{{Request::root()}}/images/dhan.jpg">
				<ul class="browse_repo">
					<?php foreach($subjects as $subject) {?>
					<li class="col-md-12 col-sm-6">
						<a href="{{Request::root()}}/browse/subject/{{$subject->id}}">
							{{$subject->name}}
						</a>
					</li>
					<?php } ?>
				</ul>
				<div class="form-group">
					<a href="{{Request::root()}}/all/subjects" class="btn btn-primary">Show All</a>
				</div>
			</div>

        </div>
    </div>



</section>
<script>
$('#author_select').on('change', function() {
  	//alert( $(this).val() );
	location.href = '{{ Request::root() }}/browse/authors';
});
</script>