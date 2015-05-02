<?php

class Vaccine extends Eloquent { 

	protected $fillable = array( 'name' );

    public function pets() {
        return $this->belongsToMany( 'Pet' );
    }
}