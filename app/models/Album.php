<?php

class Album extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'slug', 'description','is_active'];
	
	public function OrmPhoto() {
		return $this->hasMany('Photo');
	}	
	
	public function OrmCoverAlbum() {
		return $this->hasMany('Photo', 'album_id')->where('is_cover', '=', 'Y');
	}

}