    <tr>
	<td>{{ $entry->name }} ({{ $entry->name_nepali }})
		<div style='float:right;padding-right:12px;'>
			<span>
				<a href="{{ Request::root() }}/admin/books/lists/{{ $entry->id }}">View Books</a> | </span>
	       <span>
			<?php if ($entry->is_active == 1) {?>
				<font style="color:#99CC33">Active</font>
			<?php } else { ?>
				<font style="color:#FF0000">Deactive</font>													
			<?php } ?>
			</span>	
			<span>| &nbsp;</span>															
				<span><a href="{{ Request::root() }}/admin/categories/{{ $entry->id }}/edit"><i class="icon-edit"></i></a></span> 
	</div>
	 @if (count($entry['children']) > 0)
	 <ul style="list-style:none;padding:5px;">
	 	@foreach($entry['children'] as $entry)
		 	@include('admin.partials.category', $entry)
        @endforeach
	</ul>	
	@endif
	</td>
	</tr>