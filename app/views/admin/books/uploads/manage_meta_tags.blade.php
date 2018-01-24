<div class="tab-pane <?php if (Input::get('tab') == 3) echo 'active';?>" id="t3">
	<div class="box-content">
		<form method="post" action="{{ Request::root() }}/admin/books/post_meta_tags" class="form-vertical">
			<input type="hidden" name="book_id" value="{{ $book->id }}">
			
			<div class="control-group">
					<label for="textfield" class="control-label"><h4>Add meta tags (press "tab" to input new meta key words)</h4></label>
					<div class="controls">
						<div class="span12"><input type="text" name="tags" id="textfield" class="tagsinput" value="<?php echo $tags;?>"></div>
					</div>
			</div>	<br />		
			
			<?php /*?><div class="control-group">
				<label for="textarea" class="control-label"><strong>Add meta tags: (seperate by comma)</strong></label>
				<div class="controls">
				{{ Form::textarea('tags', null, array('width' => '400','size' => '50x6', 'placeholder'=>'')) }}													
				</div>
			</div><?php */?>		
<?php
	$cancel_url = (Auth::user()->role_id == 3)?'admin/your_items' : 'admin/books';
?>				
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<a href="{{ Request::root() }}/{{ $cancel_url }}" class="btn">Cancel</a>
			</div>			
		</form>
	</div>	
</div>	