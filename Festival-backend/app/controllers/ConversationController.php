<?php namespace Api\Controllers;

use Conversation, Response, Input, DB;

class ConversationController extends \BaseController {

    public $restful = true;

    public function get_index()
    {


        return Response::json(Conversation::all())->setCallback(Input::get('callback'));

    }

    public function post_index()
    {
        $conversation = new Conversation();
        $conversation->from_id   = Input::get('currentuser');
        $conversation->to_id    = Input::get('friend');
        $conversation->text    = Input::get('text');

        $conversation->save();

        return Response::json(Conversation::all())->setCallback(Input::get('callback'));

    }

    public function put_index()
    {

    }

    public function delete_index($id = null)
    {

    }

}