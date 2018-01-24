<?php

class Category extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['parent_id', 'name', 'name_nepali', 'is_active', 'slug','photo', 'publication_id', 'subject_id'];

 	public function parent() {
        return $this->hasOne('Category', 'id', 'parent_id');
    }	
	
	public function children() {
        return $this->hasMany('Category', 'parent_id', 'id');
    }
   
	public static function filteredTree($parent_id) {
				return static::with(implode('.', array_fill(0, 10, 'children')))
											->where('id', '=', $parent_id)
											->orderBy('name', 'ASC')
											->get();			
	
	}
	public static function tree() {
			return static::with(implode('.', array_fill(0, 10, 'children')))
											->where('parent_id', '=', 0)
											->orderBy('name', 'ASC')
											->get();			
	}

	public static function tree_child($parent_id) {
			return static::with(implode('.', array_fill(0, 10, 'children')))
											->where('parent_id', '=', $parent_id)
											->orderBy('name', 'ASC')
											->get();			
	}

}