<?php

class Slider extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'content', 'photo', 'button_text','url', 'is_active'];

}