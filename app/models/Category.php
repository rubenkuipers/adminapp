<?php

class Category extends Eloquent {
	protected $fillable = array('name');

	public function projects() {
        return $this->hasMany('Project');
    }
}
