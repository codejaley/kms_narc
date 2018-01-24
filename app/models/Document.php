<?php

class Document extends \Eloquent {

	protected $table = 'documents';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title','name', 'book_id', 'description'];
	
	public function OrmBook() {
		return $this->belongsTo('Book', 'book_id');
	}			

}