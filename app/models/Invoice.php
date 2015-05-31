<?php

class Invoice extends Eloquent {
	// protected $table = 'invoices';
	protected $fillable = array('date', 'client_id', 'number', 'description', 'price_exc_btw', 'price_inc_btw', 'paid', 'project_id');	

	public function client() {
        return $this->belongsTo('Client');
    }

    public function project() {
    	return $this->belongsTo('Project');
    }
}
