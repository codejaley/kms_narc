<?php

class Photo extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['album_id', 'photo', 'caption', 'is_cover', 'is_active'];

}