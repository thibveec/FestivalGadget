<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 20:44
 */

class LineupTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lineups')->truncate();
        Lineup::create(array(
        'artist' => 'Tjesto',
        'performanceday' => '09-06-2014',
        'performancestart' => '20:00',
        'performanceend' => '22:00',
        'stage_id' => '2',
        'festival_id' => '1'

    ));
        Lineup::create(array(
            'artist' => 'Calvin Harris',
            'performanceday' => '09-06-2014',
            'performancestart' => '18:00',
            'performanceend' => '20:00',
            'stage_id' => '2',
            'festival_id' => '1'

        ));
        Lineup::create(array(
            'artist' => 'Martin Solveg',
            'performanceday' => '09-06-2014',
            'performancestart' => '21:00',
            'performanceend' => '22:00',
            'stage_id' => '2',
            'festival_id' => '1'

        ));
        Lineup::create(array(
            'artist' => 'Chuckie',
            'performanceday' => '09-06-2014',
            'performancestart' => '19:00',
            'performanceend' => '20:00',
            'stage_id' => '3',
            'festival_id' => '1'

        ));
        Lineup::create(array(
            'artist' => 'The Cure',
            'performanceday' => '19-06-2014',
            'performancestart' => '20:00',
            'performanceend' => '22:00',
            'stage_id' => '4',
            'festival_id' => '2'

        ));
        Lineup::create(array(
            'artist' => 'Iron Maiden',
            'performanceday' => '19-06-2014',
            'performancestart' => '19:00',
            'performanceend' => '20:00',
            'stage_id' => '4',
            'festival_id' => '2'

        ));

    }

}