<?php

class Friend extends Eloquent{


    public function user()
    {
        return $this->belongsTo('User');
    }

}

?>