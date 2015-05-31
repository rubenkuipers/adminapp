<?php
class Setting extends Eloquent {
    protected $fillable = array('name', 'adress', 'zipcode', 'city', 'website', 'email', 'phone', 'btw_nr', 'kvk_nr', 'iban', 'bic_nr');
}