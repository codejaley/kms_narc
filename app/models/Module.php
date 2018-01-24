<?php

class Module extends \Eloquent {
	protected $fillable = ['module_name','parent_id','module_link', 'module_class', 'module_position','is_active','is_hidden'];
}