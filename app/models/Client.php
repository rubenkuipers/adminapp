<?php

class Client extends Eloquent {
	protected $fillable = array('name', 'adress', 'zipcode', 'city', 'website', 'email', 'phone');

	public function invoices() {
        return $this->hasMany('Invoice');
    }

    public function projects() {
        return $this->hasMany('Project');
    }

}
