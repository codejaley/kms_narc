<link href="/frontend_root/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<section>
	<div class="container bg_grey shadow inner_container">
		<div class="row">
			
            <div class="col-md-8">
				<h2>Advance Search</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li class="active">Advance Search</li>
                    </ol>
                </div>			
			
			<form method="post" action="{{ Request::root() }}/adv/result" name="adv_search_frm">
				<div class="blog-post">
					<div class="form-group">
							<label>Parent category</label>
								{{ Form::select('parent_id', $categories , $selected_cat, array('id'=> 'parent_category','class' => 'form-control')) }}	
						</div>	
						
					<div class="form-group">
						<label>Subcategory</label>
						<?php if (sizeof($child_lists) > 0) {  										
						?>
							<select multiple="multiple" id="my-select" name="cat_ids[]">
								 <?php foreach($child_lists as $key=>$value) { ?>
									 <option value='{{ $key }}'>{{ $value }}</option>
								<?php } ?>
							</select>		
						<?php } else {?>
							<p style="color:#ff0000">Sub category not found!</p>
						<?php } ?>	
					</div>
					
					<div class="form-group">
						<label>Author</label>
						{{ 	Form::select('authors[]', $author_lists, '', array('multiple' => true ,'class' => 'multiselect','id' => 'author-select', 'style')); }}
					</div>
						
					<div class="form_group">
							<label>Search for keyword</label>
							<input type="text" name="search_keyword" class="form-control" id="exampleInputEmail1" placeholder="Search keyword">		
						</div>	<br />
						
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Search</button>	
					</div>
							
				</div>
			</form>
		</div>
		@include('frontend.includes.inner_pages_sidebar')		
		</div>
</section>
<script src="/frontend_root/js/jquery.multi-select.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('#my-select').multiSelect();
		$('#author-select').multiSelect();
		
		$('#parent_category').on('change', function (e) {
			var optionSelected = $("option:selected", this);
			var parent_cat = (optionSelected.val());
			location.href = '{{ Request::root() }}/search/advance?parent=' + parent_cat;
		});		
	});
</script>



