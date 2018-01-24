<?php

class Book extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'slug','category_id','publisher_id', 'user_id', 'name_nepali','image','description','description_nepali','published_date','date_format', 'is_active','photo'];
	
	public function OrmCategory() {
		return $this->belongsTo('Category', 'category_id');
	}

	public function OrmPublisher() {
		return $this->belongsTo('Publisher', 'publisher_id');
	}
	
	public function OrmDocument() {
		return $this->hasMany('Document', 'book_id');
	}
	
	public function OrmUser() {
		return $this->belongsTo('User', 'user_id');
	}				
}