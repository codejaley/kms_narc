<?php

class Project extends \Eloquent {
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'photo', 'start_date', 'end_date','description', 'service_desription', 'is_active'];
	
	public function OrmProjectCountry() {
		return $this->hasMany('ProjectCountry', 'project_id');
	}
	
	public function OrmCountry() {
		return $this->belongsTo('Country', 'country_id');
	}
	
	public function OrmClient() {
		return $this->belongsTo('Client', 'client_id');
	}		

}