<?php namespace Api\Controllers;

use User, Auth, Response, Redirect, Input, DB, Validator, Exception;

class UserController extends \BaseController {

    public $restful = true;

    public function get_index()
    {

        return Response::json(User::all())->setCallback(Input::get('callback'));

    }

    public function post_index()
    {

        $user = new User();
        $user->username   = Input::get('username');
        $user->email    = Input::get('email');
        $user->password    = Input::get('password');
        $user->role_id    = '2';
        $user->save();

        return Response::json(User::all())->setCallback(Input::get('callback'));
    }
    public function post_login()
    {
        try {
        $input = Input::all();

        $rules = array('email' => 'required', 'password' => 'required');

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $credentials = [
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),

            ];

            if (! Auth::attempt($credentials))
                throw new Exception("Incorrect email or password.");

            if(Auth::User()->id == 0)
                throw new Exception("We can't find the account you are associated with.");

            $user = DB::table('users')->where('email', $input['email'])->pluck('username');
            $email = DB::table('users')->where('email', $input['email'])->pluck('email');
            $id = DB::table('users')->where('email', $input['email'])->pluck('id');
            $roleId = DB::table('users')->where('email', $input['email'])->pluck('role_id');
            $role = DB::table('roles')->where('id', $roleId)->pluck('rolename');


            $data = array(
                'success' => '',
                'username' => $user,
                'email' => $email,
                'user_id' => $id,
                'role' => $role
            );

            return Response::json($data);
        }else{
            throw new Exception("Please fill in the email or password.");
        }
        } catch(Exception $e) {


                $data = array(
                    'error' => $e->getMessage()
                );

                return Response::json($data);
            }


    }

    public function get_logout()
    {
        try {
            return Auth::logout();
        } catch(Exception $e) {
            return $e->getMessage();
        }
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