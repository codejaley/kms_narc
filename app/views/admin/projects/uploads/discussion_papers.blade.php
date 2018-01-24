{{ HTML::style('/admin_root/css/plugins/plupload/jquery.plupload.queue.css') }}
{{ HTML::script('/admin_root/js/plugins/plupload/plupload.full.js') }}
{{ HTML::script('/admin_root/js/plugins/plupload/jquery.plupload.queue.js') }}
{{ HTML::script('/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js') }}
{{ HTML::script('/admin_root/js/plugins/mockjax/jquery.mockjax.js') }}
<div class="tab-pane <?php if (Input::get('tab') == 5) echo 'active';?>" id="t5">
<?php if($project_discussion_papers->count() > 0) { ?>	
<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Project Discussion Papers
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Report</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($project_discussion_papers as $project_discussion_paper) { ?>
											<tr>
												<td><?php echo $project_discussion_paper->report_name; ?></td>
												<td><a onclick="return confirm('Are you sure?')" href="{{ Request::root() }}/admin/projects_type/delete/{{ $project_id }}/{{ $project_discussion_paper->id }}/?type=discussion_papers"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
<?php } ?>
	<h4>Upload Project Discussion Papers</h4>
	<div class="box-content nopadding">
		<div class="discussion_papers">
		</div>
	</div>	
</div>
<script>
	if($('.discussion_papers').length > 0){
		$(".discussion_papers").each(function(){
			var $el = $(this);
			$el.pluploadQueue({
				runtimes : 'html5,gears,flash,silverlight,browserplus',
				url : '<?php echo Request::root();?>/admin/projects/upload_project_discussion_papers/' + '<?php echo $project->id;?>',
				max_file_size : '40mb',
				chunk_size : '40mb',
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
					location.href = '<?php echo Request::root()?>/admin/projects/manage_project/' + <?php echo $project->id?> + '?tab=5';
				});		
		});
}
</script>