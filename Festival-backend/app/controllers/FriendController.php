<?php namespace Api\Controllers;

use Friend, FriendRequest, Response, Input, DB;

class FriendController extends \BaseController {

    public $restful = true;

    public function get_index()
    {
        return Response::json(Friend::all())->setCallback(Input::get('callback'));

    }

    public function post_index()
{

    $friend = new Friend();
    $friend->friend1_id   = Input::get('currentuser');
    $friend->friend2_id    = Input::get('askeduser');
    $friend->status    = Input::get('status');

    $friend->save();

    return Response::json(Friend::all())->setCallback(Input::get('callback'));

}
    public function post_friendrequest()
    {

        $friendrequest = new FriendRequest();
        $friendrequest->from_id   = Input::get('currentuser');
        $friendrequest->to_id    = Input::get('askeduser');
        $friendrequest->status    = Input::get('status');

        $friendrequest->save();

        return Response::json(FriendRequest::all())->setCallback(Input::get('callback'));

    }
    public function get_friendrequest(){
        return Response::json(FriendRequest::all())->setCallback(Input::get('callback'));
    }

    public function put_friends()
    {
            $fromuser = Input::get('fromuser');
            $touser = Input::get('touser');

        $friendId = DB::table('friends')->where('friend1_id', $fromuser)->where('friend2_id', $touser)->pluck('id');

        $updatefriend = Friend::find($friendId);
        $updatefriend->friend1_id   = Input::get('fromuser');
        $updatefriend->friend2_id    = Input::get('touser');
        $updatefriend->status    = Input::get('status');

        $updatefriend->save();

        return Response::json(Friend::all())->setCallback(Input::get('callback'));


    }

    public function delete_index($id = null)
    {

    }

}