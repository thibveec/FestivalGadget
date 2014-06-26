<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('api/v1/festivals', array('as' => 'api.festivals', 'uses' => 'Api\Controllers\FestivalController@get_index'));
Route::post('api/v1/festivals', array('as' => 'api.festivals', 'uses' => 'Api\Controllers\FestivalController@post_index'));
Route::get('api/v1/conversations', array('as' => 'api.conversations', 'uses' => 'Api\Controllers\ConversationController@get_index'));
Route::post('api/v1/conversations', array('as' => 'api.conversations', 'uses' => 'Api\Controllers\ConversationController@post_index'));
Route::get('api/v1/users', array('as' => 'api.users', 'uses' => 'Api\Controllers\UserController@get_index'));
Route::post('api/v1/users', array('as' => 'api.users', 'uses' => 'Api\Controllers\UserController@post_index'));
Route::get('api/v1/loginuser', array('as' => 'api.users', 'uses' => 'Api\Controllers\UserController@get_index'));
Route::get('api/v1/logoutuser', array('as' => 'api.users', 'uses' => 'Api\Controllers\UserController@get_logout'));
Route::post('api/v1/loginuser', array('as' => 'api.users', 'uses' => 'Api\Controllers\UserController@post_login'));
Route::get('api/v1/lineups', array('as' => 'api.lineups', 'uses' => 'Api\Controllers\LineupController@get_index'));
Route::get('api/v1/colors', array('as' => 'api.colors', 'uses' => 'Api\Controllers\ColorController@get_index'));
Route::get('api/v1/friends', array('as' => 'api.friends', 'uses' => 'Api\Controllers\FriendController@get_index'));
Route::post('api/v1/friends', array('as' => 'api.friends', 'uses' => 'Api\Controllers\FriendController@post_index'));
Route::get('api/v1/requestfriends', array('as' => 'api.friends', 'uses' => 'Api\Controllers\FriendController@get_friendrequest'));
Route::post('api/v1/requestfriends', array('as' => 'api.friends', 'uses' => 'Api\Controllers\FriendController@post_friendrequest'));
Route::put('api/v1/friends', array('as' => 'api.friends', 'uses' => 'Api\Controllers\FriendController@put_friends'));

Route::group(array('prefix' => 'admin'), function()
{
    Route::group(array('before' => 'auth'), function()
    {
    Route::any('/',                'App\Controllers\Admin\FestivalsController@index');


        Route::put('lineups/addstage/{id}', array('as' => 'admin.lineups.addstage', 'uses' => 'App\Controllers\Admin\LineupController@addstage'));
        Route::put('lineups/updatestage/{id}', array('as' => 'admin.lineups.updatestage', 'uses' => 'App\Controllers\Admin\LineupController@updatestage'));

    Route::resource('lineups',    'App\Controllers\Admin\LineupController');
    Route::resource('festivals',       'App\Controllers\Admin\FestivalsController');
        Route::resource('users',       'App\Controllers\Admin\UsersController');
        Route::resource('stages',       'App\Controllers\Admin\StagesController');
        Route::resource('colors',       'App\Controllers\Admin\ColorsController');

    });

    Route::get('logout', 'App\Controllers\Admin\AuthController@getLogout');
    Route::get('login', 'App\Controllers\Admin\AuthController@getLogin');
    Route::post('login',  'App\Controllers\Admin\AuthController@postLogin');
    Route::get('/logout', [
        'as'   => 'admin.logout',
        function () {
            Auth::logout();

            return Redirect::to('/admin/login');
        }
    ])->before('auth');

});