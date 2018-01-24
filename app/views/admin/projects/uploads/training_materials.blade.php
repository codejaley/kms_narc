{{ HTML::style('/admin_root/css/plugins/plupload/jquery.plupload.queue.css') }}
{{ HTML::script('/admin_root/js/plugins/plupload/plupload.full.js') }}
{{ HTML::script('/admin_root/js/plugins/plupload/jquery.plupload.queue.js') }}
{{ HTML::script('/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js') }}
{{ HTML::script('/admin_root/js/plugins/mockjax/jquery.mockjax.js') }}
<div class="tab-pane <?php if (Input::get('tab') == 6) echo 'active';?>" id="t6">
<?php if($project_training_meterials->count() > 0) { ?>	
<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Project Training Meterials
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
									<?php foreach($project_training_meterials as $project_training_meterial) { ?>
											<tr>
												<td><?php echo $project_training_meterial->report_name; ?></td>
												<td><a onclick="return confirm('Are you sure?')" href="{{ Request::root() }}/admin/projects_type/delete/{{ $project_id }}/{{ $project_training_meterial->id }}/?type=training_meterials"><i class="icon-remove-sign"></i> Delete</a></td>	
											</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
<?php } ?>
	<h4>Upload Project Training Meterials</h4>
	<div class="box-content nopadding">
		<div class="training_materials">
		</div>
	</div>	
</div>
<script>
	if($('.training_materials').length > 0){
		$(".training_materials").each(function(){
			var $el = $(this);
			$el.pluploadQueue({
				runtimes : 'html5,gears,flash,silverlight,browserplus',
				url : '<?php echo Request::root();?>/admin/projects/upload_project_training_meterials/' + '<?php echo $project->id;?>',
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
					location.href = '<?php echo Request::root()?>/admin/projects/manage_project/' + <?php echo $project->id?> + '?tab=6';
				});		
		});
}
</script>