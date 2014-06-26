<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 21:22
 */

class Role extends Eloquent{

    public function user()
    {
        return $this->hasMany('User');
    }
}

?>