<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 19:09
 */

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        User::create(array(
            'username' => 'thibveec2',
            'email' => 'thibaultve@hotmail.com',
            'password' => 'lomperik',
            'role_id' => '1'

        ));
        User::create(array(
            'username' => 'thibveec1',
            'email' => 'thibaultve1@hotmail.com',
            'password' => 'lomperik',
            'role_id' => '2'
        ));

    }

}