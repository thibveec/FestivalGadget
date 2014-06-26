<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 21:21
 */


class Lineup extends Eloquent{

    public function festival()
    {
        return $this->belongsTo('Festival');
    }
    public function stage()
    {
        return $this->belongsTo('Stage');
    }

}

?>