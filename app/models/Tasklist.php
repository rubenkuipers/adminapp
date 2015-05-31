<?php

class Tasklist extends Eloquent {
	protected $fillable = array('project_id');	
	// 
	public function tasks() {
        return $this->hasMany('Task');
    }

    public function project() {
        return $this->belongsTo('Project');
    }
}