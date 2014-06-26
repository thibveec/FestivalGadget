<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 20:44
 */

class FestivalTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('festivals')->truncate();
        Festival::create(array(
            'name' => 'tomorrowland',
            'genre' => 'dance/house',
            'festivalstart' => '09-06-2014',
            'festivalend' => '11-06-2014',

        ));
        Festival::create(array(
            'name' => 'rock werchter',
            'genre' => 'rock/pop',
            'festivalstart' => '19-06-2014',
            'festivalend' => '21-06-2014',

        ));

    }

}