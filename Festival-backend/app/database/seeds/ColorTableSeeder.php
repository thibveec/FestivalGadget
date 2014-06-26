<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 20:44
 */

class ColorTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->truncate();
        Color::create(array(
            'colorname' => 'cobalt',
            'value' => '#0050ef',


        ));
        Color::create(array(
            'colorname' => 'crimson',
            'value' => '#a20025',


        ));

    }

}