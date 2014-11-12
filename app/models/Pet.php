<?php

class Pet extends Eloquent { 

    public function user() {
        return $this->belongsTo('User');
    }

    public function vet() {
        return $this->belongsTo('Vet');
    }

    public function vaccines() {
        return $this->belongsToMany('Vaccine');
    }
}