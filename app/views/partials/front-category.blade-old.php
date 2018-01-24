<?php
	$total_books = Book::where('category_id', '=', $category['id'])->where('is_active', '=', 1)->count();
?>
<ul class="list-group">
	<?php if ($total_books > 0) { ?>
		<li class="list-group-item">
			<a href="{{ Request::root() }}/items/category/{{ $category['id'] }}">{{ $category['name'] }} 
			</a> <br />Item(s) : {{ $total_books }}<?php /*?>, Subcategory : <?php echo count($category['children']); ?> <?php */?>
		</li>	
	<?php } else { ?>
		<li class="list-group-item">
			{{ $category['name'] }}  <br />Item(s) : {{ $total_books }}<?php /*?>, Subcategory : <?php echo count($category['children']); ?> <?php */?>
		</li>		
	<?php } ?>

	
	@if (count($category['children']) > 0)
		<ul>
			@foreach($category['children'] as $category)
				@include('partials.front-category', $category)
			@endforeach
		</ul>		
	@endif
</ul>