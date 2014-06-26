<?php namespace Api\Controllers;

use Lineup, Response, Input, DB;

class LineupController extends \BaseController {

    public $restful = true;

    public function get_index()
    {
        $lineups = Lineup::orderBy('performanceday', 'ASC')->orderBy('performancestart', 'ASC')->get();

        foreach ($lineups as $key => $lineup) {

            $lineup['stage_id'] = DB::table('stages')->where('id', $lineup['stage_id'])->pluck('stagename');

        }

        return Response::json($lineups)->setCallback(Input::get('callback'));

    }

    public function post_index()
    {


    }

    public function put_index()
    {

    }

    public function delete_index($id = null)
    {

    }

}