<?php namespace Api\Controllers;

use Color, Response, Input, DB;

class ColorController extends \BaseController {

    public $restful = true;

    public function get_index()
    {
        return Response::json(Color::all())->setCallback(Input::get('callback'));

    }

    public function post_index()
    {


    }

    public function put_index()
    {

    }

    public function delete_index($id = null)
    {

    }

}