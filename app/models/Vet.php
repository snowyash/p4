<?php

class Vet extends Eloquent { 

    public function pet() {
        return $this->hasMany( 'Pet' );
    }
}