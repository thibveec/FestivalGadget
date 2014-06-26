<?php

class Festival extends Eloquent{



    public function lineup()
    {
        return $this->hasMany('Lineup');
    }
}

?>