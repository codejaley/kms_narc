{{ HTML::style('/admin_root/css/plugins/plupload/jquery.plupload.queue.css') }}
{{ HTML::script('/admin_root/js/plugins/plupload/plupload.full.js') }}
{{ HTML::script('/admin_root/js/plugins/plupload/jquery.plupload.queue.js') }}
{{ HTML::script('/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js') }}
{{ HTML::script('/admin_root/js/plugins/mockjax/jquery.mockjax.js') }}

<div class="tab-pane <?php if (Input::get('tab') == 2) echo 'active';?>" id="t2">
	
<?php if($documents->count() > 0) { ?>	
		<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Documents
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<!--<th>Title</th>-->
											<th>Document</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($documents as $document) { ?>
											<tr>
												<?php /*?><td>
													
													
													<div id="title_edit_box" style="display:none;">
														<input style="width:500px;" type="text" name="document_title" id="document_title" value="{{ $document->title }}" /> 
														<input type="hidden" name="" />
														<br />
														<input type="button" value="Save" id="btn_save" />
													</div>
													
													
													<?php if ($document->title == '') { ?>
														<input style="width:500px;" type="text" name="document_title" id="document_title" value="{{ $document->title }}" /> 
														<input type="hidden" name="" />
														<br />
														<input type="button" value="Save" id="btn_save" />
														<br /><a href="#" id="btn_cancel_edit">Cancel</a>
													<?php } else {?>
												{{ $document->title }} <br />
												<a href="#" id="btn_edit_title">Edit</a><br />
												
													<?php } ?>
												</td><?php */?>
												<td><a target="_blank" href="{{ Request::root() }}/dms_books/{{ $document->name }}"><?php echo $document->name; ?></a></td>
												<td><a onclick="return confirm('Are you sure?')" href="{{ Request::root() }}/admin/books/delete/{{ $document->id }}?book_id={{ $document->book_id }}"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>	
	<?php } ?>
	<div class="box-content nopadding">
		<h4>Upload Book Documents</h4>
		<div class="plupload_reports">
		</div>
	</div>	
</div>

<script>
	if($('.plupload_reports').length > 0){
		$(".plupload_reports").each(function(){
			var $el = $(this);
			$el.pluploadQueue({
				runtimes : 'html5,gears,flash,silverlight,browserplus',
				url : '<?php echo Request::root();?>/admin/books/upload_book_documents/' + '<?php echo $book->id;?>',
				max_file_size : '5000mb',
				chunk_size : '5000mb',
				unique_names : true,
				//resize : {width : 320, height : 240, quality : 90},
				filters : [
					{title : "Pdf", extensions : "pdf"},
				],
				flash_swf_url : 'js/plupload/plupload.flash.swf',
				silverlight_xap_url : 'js/plupload/plupload.silverlight.xap'
			});
			$(".plupload_header").remove();
			var upload = $el.pluploadQueue();
			if($el.hasClass("pl-sidebar")){
				$(".plupload_filelist_header,.plupload_progress_bar,.plupload_start").remove();
				$(".plupload_droptext").html("<span>Drop files to upload</span>");
				$(".plupload_progress").remove();
				$(".plupload_add").text("Or click here...");
				upload.bind('FilesAdded', function(up, files) {
					setTimeout(function () { 
						up.start(); 
					}, 500);
				});
				upload.bind("QueueChanged", function(up){
					$(".plupload_droptext").html("<span>Drop files to upload</span>");
				});
				upload.bind("StateChanged", function(up){
					$(".plupload_upload_status").remove();
					$(".plupload_buttons").show();
				});			
			} else {
				$(".plupload_progress_container").addClass("progress").addClass('progress-striped');
				$(".plupload_progress_bar").addClass("bar");
				$(".plupload_button").each(function(){
					if($(this).hasClass("plupload_add")){
						$(this).attr("class", 'btn pl_add btn-primary').html("<i class='icon-plus-sign'></i> "+$(this).html());
					} else {
						$(this).attr("class", 'btn pl_start btn-success').html("<i class='icon-cloud-upload'></i> "+$(this).html());
					}
				});
			}
				upload.bind("UploadComplete", function(up){
					location.href = '<?php echo Request::root()?>/admin/books/manage_book/' + <?php echo $book->id?> + '?tab=2';
				});		
		});
}
</script>