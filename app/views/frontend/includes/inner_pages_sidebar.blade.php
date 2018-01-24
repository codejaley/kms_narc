<?php
		$query = "SELECT 
					users.id,
					users.firstname,
					count(book_users.id) as total_books
					FROM 
						users 
					LEFT JOIN book_users On(users.id=book_users.user_id)
					LEFT JOIN books ON(book_users.book_id=books.id)
					WHERE 1=1
						AND users.role_id='4'
						AND books.is_active='1'
					GROUP BY 
						users.firstname
					HAVING total_books > 0	
					ORDER BY 
						total_books DESC
					LIMIT 0,10";
		$authors =  DB::select(DB::raw($query));
?>
<div class="col-md-4"> <h2>Browse By Author</h2>

<?php if (count($authors) == 0) {?>
<p>No author found</p>
<?php } ?>


<?php if (count($authors) > 0) {?>
	<ul class="browse_repo">
		<?php foreach($authors as $author) { ?>
			<li class="col-md-12 col-sm-6">
				<a href="{{ Request::root() }}/browse/author/{{ $author->id }}">{{ $author->firstname }}({{ $author->total_books }})</a> 
			</li>
		<?php } ?>
	</ul>

	<div class="form-group">
		<select id="maxOption21" class="selectpicker show-menu-arrow form-control" multiple data-max-options="1">
			<option value="name">Name</option>
			<option value="most_visited">Most Visited</option>
		</select>

	</div>
<?php } ?>	
</div>
