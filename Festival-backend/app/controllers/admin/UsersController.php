<?php namespace App\Controllers\Admin;

use User, Role;

use Input, Notification, View, Redirect, Validator, DB, Str;

class UsersController extends \BaseController {

    public function index()
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            $user['role_id'] = DB::table('roles')->where('id', $user['role_id'])->pluck('rolename');
        }
            return View::make('admin.users.index')->with('users', $users);
    }

    public function show($id)
    {
        $getroleid = DB::table('users')->where('id', $id)->pluck('role_id');
        $userrole =  DB::table('roles')->where('id', $getroleid)->pluck('rolename');
        return View::make('admin.users.show')->with('user', User::find($id))
            ->with('role',$userrole);
    }

    public function create()
    {
        $selectrole = Role::lists('rolename', 'id');
        return View::make('admin.users.create')->with('roles', $selectrole);
    }

    public function store()
    {
        $input = Input::all();

        $rules = array(
            'username' => 'required',
            'email' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $user = new User();
            $user->username   = Input::get('username');
            $user->email    = Input::get('email');
            $user->password    = Input::get('password');
            $user->role_id    = Input::get('role');

            $user->save();

            // Notification::success('The festival was saved.');

            return Redirect::route('admin.users.show', $user->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function edit($id)
    {
        $getroleid = DB::table('users')->where('id', $id)->pluck('role_id');
        $userrole =  DB::table('roles')->where('id', $getroleid)->pluck('rolename');
        $selectrole = Role::lists('rolename', 'id');
        return View::make('admin.users.edit')->with('user', User::find($id))
            ->with('roles', $selectrole)
            ->with('role',$userrole);
    }

    public function update($id)
    {
        $input = Input::all();

        $rules = array(
            'username' => 'required',
            'email' => 'required',
        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $user = User::find($id);
            $user->username   = Input::get('username');
            $user->email    = Input::get('email');

            $user->role_id    = Input::get('role');
            $user->save();

            // Notification::success('The Festival was saved.');

            return Redirect::route('admin.users.show', $user->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        //  Notification::success('The festival was deleted.');

        return Redirect::route('admin.users.index');
    }

}