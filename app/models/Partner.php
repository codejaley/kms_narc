<?php

class Partner extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'country', 'url', 'logo', 'is_active'];
	
	public function OrmCountry() {
		return $this->belongsTo('Country', 'country');
	}		

}