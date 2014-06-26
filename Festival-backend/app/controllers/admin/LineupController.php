<?php namespace App\Controllers\Admin;

use Lineup, Festival, Stage;

use Input, Notification, View, Redirect, Validator, DB, Str;

class LineupController extends \BaseController {

    public function index()
    {
        $lineups = Lineup::all();
        foreach ($lineups as $key => $lineup) {
            $lineup['festival_id'] = DB::table('festivals')->where('id', $lineup['festival_id'])->pluck('name');
            $lineup['stage_id'] = DB::table('stages')->where('id', $lineup['stage_id'])->pluck('stagename');

        }
        return View::make('admin.lineups.index')->with('lineups',$lineups);
    }

    public function show($id)
    {
        $getfestivalid = DB::table('lineups')->where('id', $id)->pluck('festival_id');
        $getstageid = DB::table('lineups')->where('id', $id)->pluck('stage_id');
        $lineupfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('name');
        $lineupstage =  DB::table('stages')->where('id', $getstageid)->pluck('stagename');
        return View::make('admin.lineups.show')->with('lineup', Lineup::find($id))
          ->with('festival',$lineupfestival)
            ->with('stage', $lineupstage);
    }



    public function create()
    {

        $selectfestival = Festival::lists('name', 'id');

        return View::make('admin.lineups.create')->with('festivals', $selectfestival)
           ;
    }

    public function store()
    {
        $input = Input::all();

        $rules = array(
            'artist' => 'required',
            'festival' => 'required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $lineup = new Lineup();
            $lineup->artist   = Input::get('artist');
            $lineup->stage_id    = '1';

            $lineup->performancestart    = Input::get('performancestart');
            $lineup->performanceend    = Input::get('performanceend');
            $lineup->festival_id    = Input::get('festival');
            $festivalstartdate =  Festival::find($lineup->festival_id);
            $lineup->performanceday = $festivalstartdate->festivalstart;
            $lineup->save();

            // Notification::success('The lineup was saved.');
            // Add a stage to the lineup
            $getfestivalid = DB::table('lineups')->where('id', $lineup->id)->pluck('festival_id');
            $lineupfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('name');
            $startdayfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('festivalstart');
            $enddayfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('festivalend');
            $stagetofestival = DB::table('stages')->where('festival_id', '=', $getfestivalid)->lists('stagename', 'id');
            return View::make('admin.lineups.addStage')->with('lineup', Lineup::find($lineup->id))
                ->with('festival',$lineupfestival)
                ->with('stages',$stagetofestival)
                ->with('festivalstart',$startdayfestival)
                ->with('festivalend',$enddayfestival);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }

    public function edit($id)
    {
        $getfestivalid = DB::table('lineups')->where('id', $id)->pluck('festival_id');
        $lineupfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('name');

        $selectfestival = Festival::lists('name', 'id');
        return View::make('admin.lineups.edit')->with('lineup', Lineup::find($id))
            ->with('festivals', $selectfestival)
            ->with('festival',$lineupfestival)
          ;
    }

    public function addstage($id)
    {
        $input = Input::all();

        $rules = array(
            'stage' => 'required',
        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $lineup = Lineup::find($id);

            $lineup->stage_id   = Input::get('stage');
            $lineup->performanceday    = Input::get('performanceday');

            $lineup->save();

            // Notification::success('The Festival was saved.');

            return Redirect::route('admin.lineups.show', $lineup->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
    public function update($id)
    {
        $input = Input::all();

        $rules = array(
            'artist' => 'required',
        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $lineup = Lineup::find($id);

            $lineup->artist   = Input::get('artist');

            $lineup->performancestart    = Input::get('performancestart');
            $lineup->performanceend    = Input::get('performanceend');
            $lineup->festival_id    = Input::get('festival');



            $lineup->save();

            // Notification::success('The Festival was saved.');

            // Add a stage to the lineup
            $getfestivalid = DB::table('lineups')->where('id', $lineup->id)->pluck('festival_id');
            $getstageid = DB::table('lineups')->where('id', $lineup->id)->pluck('stage_id');
            $lineupfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('name');
            $stagefestival =  DB::table('stages')->where('id', $getstageid)->pluck('stagename');
            $startdayfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('festivalstart');
            $enddayfestival =  DB::table('festivals')->where('id', $getfestivalid)->pluck('festivalend');
            $stagetofestival = DB::table('stages')->where('festival_id', '=', $getfestivalid)->lists('stagename', 'id');
            return View::make('admin.lineups.editStage')->with('lineup', Lineup::find($lineup->id))
                ->with('festival',$lineupfestival)
            ->with('stage', $stagefestival)
                ->with('stages',$stagetofestival)
                ->with('festivalstart',$startdayfestival)
                ->with('festivalend',$enddayfestival);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
    public function updatestage($id)
    {
        $input = Input::all();

        $rules = array(
            'stage' => 'required',
        );

        $validation = Validator::make($input, $rules);


        if ($validation->passes())
        {
            $lineup = Lineup::find($id);

            $lineup->stage_id   = Input::get('stage');
            $lineup->performanceday    = Input::get('performanceday');

            $lineup->save();

            // Notification::success('The Festival was saved.');

            return Redirect::route('admin.lineups.show', $lineup->id);
        }

        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
    public function destroy($id)
    {
        $lineup = Lineup::find($id);
        $lineup->delete();

        //  Notification::success('The festival was deleted.');

        return Redirect::route('admin.lineups.index');
    }

}