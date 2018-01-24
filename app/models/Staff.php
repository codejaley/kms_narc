<?php

class Staff extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'photo', 'staff_type', 'description','ordering','is_active'];

}