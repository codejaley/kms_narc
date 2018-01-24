<?php

class BookUser extends \Eloquent {
	
	protected $table = 'book_users';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['book_id', 'user_id'];

	public function OrmUser() {
		return $this->belongsTo('User', 'user_id');
	}
	
	public function OrmBook() {
		return $this->belongsTo('Book', 'book_id');
	}	

}