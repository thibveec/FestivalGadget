<?php namespace App\Controllers\Admin;

use Color;

use Input, Notification, View, Redirect, Validator, Str;

class ColorsController extends \BaseController {

    public function index()
    {

        return View::make('admin.colors.index')->with('colors', Color::all());

    }

    public function show($id)
    {
        return View::make('admin.colors.show')->with('color', Color::find($id));
    }

    public function create()
    {
        return View::make('admin.colors.create');
    }

    public function store()
    {
        $input = Input::all();

        $rules = array(
            'colorname' => 'required',
            'value' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $color = new Color();
            $color->colorname   = Input::get('colorname');
            $color->value    = Input::get('value');

            $color->save();

            // Notification::success('The color was saved.');

            return Redirect::route('admin.colors.show', $color->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function edit($id)
    {
        return View::make('admin.colors.edit')->with('color', Color::find($id));
    }

    public function update($id)
    {
        $input = Input::all();

        $rules = array(
            'colorname' => 'required',
            'value' => 'required',
        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $color = Color::find($id);
            $color->colorname   = Input::get('colorname');
            $color->value    = Input::get('value');

            $color->save();

            // Notification::success('The Festival was saved.');

            return Redirect::route('admin.colors.show', $color->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();

        //  Notification::success('The festival was deleted.');

        return Redirect::route('admin.colors.index');
    }

}