<?php namespace Api\Controllers;

use Festival, Response, Input, DateTime;

class FestivalController extends \BaseController {

    public $restful = true;

    public function get_index()
    {

        return Response::json(Festival::all())->setCallback(Input::get('callback'));

    }

    public function post_index()
    {

      //  $newfestival = Input::json()->all();

        $festival = new Festival();
        $festival->name   = Input::get('name');
        $festival->genre    = Input::get('genre');
        $festival->festivalstart    = Input::get('festivalstart');
        $festival->festivalend    = Input::get('festivalend');

        $festival->save();

        return Response::json(Festival::all())->setCallback(Input::get('callback'));
    }

    public function put_index()
    {
        $updatetodo = Input::json();

        $todo = Festival::find($updatetodo->id);
        if(is_null($todo)){
            return Response::json('Festival not found', 404);
        }
        $todo->title = $updatetodo->title;
        $todo->completed = $updatetodo->completed;
        $todo->save();
        return Response::eloquent($todo);
    }

    public function delete_index($id = null)
    {
        $todo = Festival::find($id);

        if(is_null($todo))
        {
            return Response::json('Festival not found', 404);
        }
        $deletedtodo = $todo;
        $todo->delete();
        return Response::eloquent($deletedtodo);
    }

}