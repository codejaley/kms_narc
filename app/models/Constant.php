<?php

class Constant extends \Eloquent {
	
	protected $primaryKey = 'id';

	
	protected $table = 'constants';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	
	
	protected $fillable = ['title','title_hidden', 'content_english', 'content_nepali'];				
}