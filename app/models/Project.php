<?php

class Project extends Eloquent {
	protected $fillable = array('description', 'price_method', 'sales_tax', 'price', 'total_price', 'delivery_date', 'finished', 'category_id', 'invoice_id', 'client_id', 'tasklist_id');	

	public function tasklist() {
        return $this->hasOne('Tasklist');
    }

    public function client() {
        return $this->belongsTo('Client');
    }

    public function invoice() {
        return $this->hasOne('Invoice');
    }

    public function category() {
        return $this->belongsTo('Category');
    }
}
