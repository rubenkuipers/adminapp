<?php

class Task extends Eloquent {
	protected $fillable = array('tasklist_id', 'date', 'description', 'hours', 'price_exc_btw');

	public function tasklist() {
        return $this->belongsTo('Tasklist');
    }	
}

