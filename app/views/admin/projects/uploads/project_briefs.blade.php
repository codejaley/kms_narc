{{ HTML::style('/admin_root/css/plugins/plupload/jquery.plupload.queue.css') }}
{{ HTML::script('/admin_root/js/plugins/plupload/plupload.full.js') }}
{{ HTML::script('/admin_root/js/plugins/plupload/jquery.plupload.queue.js') }}
{{ HTML::script('/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js') }}
{{ HTML::script('/admin_root/js/plugins/mockjax/jquery.mockjax.js') }}
<div class="tab-pane <?php if (Input::get('tab') == 4) echo 'active';?>" id="t4">
<?php if($project_briefs->count() > 0) { ?>	
<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Project Briefs
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
									<?php foreach($project_briefs as $project_brief) { ?>
											<tr>
												<td><?php echo $project_brief->report_name; ?></td>
												<td><a onclick="return confirm('Are you sure?')" href="{{ Request::root() }}/admin/projects_type/delete/{{ $project_id }}/{{ $project_brief->id }}/?type=project_briefs"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
<?php } ?>
	<h4>Upload Project Briefs</h4>
	<div class="box-content nopadding">
		<div class="project_briefs">
		</div>
	</div>	
</div>
<script>
	if($('.project_briefs').length > 0){
		$(".project_briefs").each(function(){
			var $el = $(this);
			$el.pluploadQueue({
				runtimes : 'html5,gears,flash,silverlight,browserplus',
				url : '<?php echo Request::root();?>/admin/projects/upload_project_briefs/' + '<?php echo $project->id;?>',
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
					location.href = '<?php echo Request::root()?>/admin/projects/manage_project/' + <?php echo $project->id?> + '?tab=4';
				});		
		});
}
</script>