<?php namespace App\Controllers\Admin;

use Festival;

use Input, Notification, View, Redirect, Validator, Str;

class FestivalsController extends \BaseController {

    public function index()
    {

        return View::make('admin.festivals.index')->with('festivals', Festival::all());

    }

    public function show($id)
    {
        return View::make('admin.festivals.show')->with('festival', Festival::find($id));
    }

    public function create()
    {
        return View::make('admin.festivals.create');
    }

    public function store()
    {
        $input = Input::all();

        $rules = array(
            'name' => 'required',
            'genre' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $festival = new Festival();
            $festival->name   = Input::get('name');
            $festival->genre    = Input::get('genre');
            $festival->festivalstart    = Input::get('festivalstart');
            $festival->festivalend    = Input::get('festivalend');

            $festival->save();

           // Notification::success('The festival was saved.');

            return Redirect::route('admin.festivals.show', $festival->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function edit($id)
    {
        return View::make('admin.festivals.edit')->with('festival', Festival::find($id));
    }

    public function update($id)
    {
        $input = Input::all();

        $rules = array(
            'name' => 'required',
            'genre' => 'required',
        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $festival = Festival::find($id);
            $festival->name   = Input::get('name');
            $festival->genre    = Input::get('genre');
            $festival->festivalstart    = Input::get('festivalstart');
            $festival->festivalend    = Input::get('festivalend');

            $festival->save();

           // Notification::success('The Festival was saved.');

            return Redirect::route('admin.festivals.show', $festival->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function destroy($id)
    {
        $festival = Festival::find($id);
        $festival->delete();

      //  Notification::success('The festival was deleted.');

        return Redirect::route('admin.festivals.index');
    }

}