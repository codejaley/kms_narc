<?php

class Blog extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['description', 'is_active', 'title', 'intro_text','photo', 'slug'];

}