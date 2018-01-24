<?php

class BookTag extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['book_id', 'tag_id'];
	
	public function OrmTag() {
		return $this->belongsTo('Tag', 'tag_id');
	}
	
	public function OrmBook() {
		return $this->belongsTo('Book', 'book_id');
	}		

}