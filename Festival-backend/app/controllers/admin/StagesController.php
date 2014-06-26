<?php namespace App\Controllers\Admin;

use Stage, Festival;

use Input, Notification, View, Redirect, Validator, Str, DB;

class StagesController extends \BaseController {

    public function index()
    {
        $stages = Stage::all();
        foreach ($stages as $key => $stage) {
            $stage['festival_id'] = DB::table('festivals')->where('id', $stage['festival_id'])->pluck('name');


        }
        return View::make('admin.stages.index')->with('stages', $stages);
    }

    public function show($id)
    {
        $getfestivalid = DB::table('stages')->where('id', $id)->pluck('festival_id');
        $lineupfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('name');
        return View::make('admin.stages.show')->with('stage', Stage::find($id))
            ->with('festival',$lineupfestival);
    }

    public function create()
    {
        $selectfestival = Festival::lists('name', 'id');
        return View::make('admin.stages.create')->with('festivals', $selectfestival);
    }

    public function store()
    {
        $input = Input::all();

        $rules = array(
            'stagename' => 'required',
            'festival' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $stage = new Stage();
            $stage->stagename   = Input::get('stagename');
            $stage->festival_id    = Input::get('festival');


            $stage->save();

            // Notification::success('The stage was saved.');

            return Redirect::route('admin.stages.show', $stage->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function edit($id)
    {
        $getfestivalid = DB::table('stages')->where('id', $id)->pluck('festival_id');
        $lineupfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('name');

        return View::make('admin.stages.edit')->with('stage', Stage::find($id))

            ->with('festival',$lineupfestival);
    }

    public function update($id)
    {
        $input = Input::all();

        $rules = array(
            'stagename' => 'required',

        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $stage = Stage::find($id);
            $stage->stagename   = Input::get('stagename');


            $stage->save();

            // Notification::success('The Festival was saved.');

            return Redirect::route('admin.stages.show', $stage->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function destroy($id)
    {
        $stage = Stage::find($id);
        $stage->delete();

        //  Notification::success('The festival was deleted.');

        return Redirect::route('admin.stages.index');
    }

}