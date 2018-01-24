<?php

class GmsController extends \BaseController {

	public function change_date_format() {
		$projects = Project::all();
		foreach($projects as $project) {
			if ($project->start_date != '') {
				$new_start_date = date("Y-m-d", strtotime($project->start_date));
				Project::where('id', '=', $project->id)->update(array('start_date' => $new_start_date));
			}
			
			if ($project->end_date != '') {
				$new_end_date = date("Y-m-d", strtotime($project->end_date));
				Project::where('id', '=', $project->id)->update(array('end_date' => $new_end_date));
			}	
			echo $project->id . '<br>';		
		}
		exit;
	}	
}