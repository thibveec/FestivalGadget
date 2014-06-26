<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/12/13
 * Time: 20:45
 */

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        Role::create(array(
            'rolename' => 'Admin'
        ));
        Role::create(array(
            'rolename' => 'User'
        ));

    }

}