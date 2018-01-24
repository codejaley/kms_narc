<?php

class Page extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'slug', 'photo', 'intro_text', 'description', 'is_active'];

}