<?php

class Conversation extends Eloquent{

    public function user()
    {
        return $this->belongsTo('User');
    }


}

?>