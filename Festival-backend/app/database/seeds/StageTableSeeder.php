<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 19:09
 */

class StageTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->truncate();
        Stage::create(array(
            'stagename' => 'Choose stage',
            'festival_id' => '0'

        ));
        Stage::create(array(
            'stagename' => 'Mainstage',
            'festival_id' => '1'

        ));
        Stage::create(array(
            'stagename' => 'Little stage',
            'festival_id' => '1'

        ));
        Stage::create(array(
            'stagename' => 'Big Cave stage',
            'festival_id' => '2'
        ));

    }

}