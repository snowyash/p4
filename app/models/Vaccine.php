<?php

class Vaccine extends Eloquent { 

    public function pets() {
        return $this->belongsToMany('Pet');
    }
}