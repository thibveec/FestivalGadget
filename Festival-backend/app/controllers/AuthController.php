<?php namespace App\Controllers\Admin;

use Auth, Form, DB, Validator, Input, Redirect, View;

class AuthController extends \BaseController {

    /**
     * Display the login page
     * @return View
     */
    public function getLogin()
    {
        return View::make('admin.auth.login');
    }

    /**
     * Login action
     * @return Redirect
     */
    public function postLogin()
    {

        $input = Input::all();

        $rules = array('email' => 'required', 'password' => 'required');

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $credentials = [
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),

            ];
            $roleId = DB::table('users')->where('email', $input['email'])->pluck('role_id');
           $userRole = DB::table('roles')->where('id', $roleId)->pluck('rolename');
            if($userRole != 'Admin') {
                return Redirect::to('admin/login')->withErrors('You do not have permission here !');
            }
            if (Auth::attempt($credentials)) {

                return Redirect::to('admin/');
            }else{
                return Redirect::to('/admin/login')->withErrors('username, password combination not correct')->withInput();
            }
        }else{
            return Redirect::to('/admin/login')->withErrors($validator);
        }

//        $credentials = array('email' => $input['email'], 'password' => $input['password']);
//            $roleId = DB::table('users')->where('email', $input['email'])->pluck('role_id');
//            $userRole = DB::table('roles')->where('id', $roleId)->pluck('rolename');
//            if($userRole != 'Admin') {
//                return Redirect::to('admin/login')->withErrors('You do not have permission here !');
//            }
//
//            if (!Auth::attempt($credentials)) {
//                return Redirect::to('/admin/login')->withErrors('username, password combination not correct')->withInput();
//            }
//
//            return Redirect::to('admin/');





    }

    /**
     * Logout action
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();

        return Redirect::route('admin/login');
    }

}

?>