<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('UserTableSeeder');
        $this->call('FestivalTableSeeder');
        $this->call('LineupTableSeeder');
        $this->call('RoleTableSeeder');
        $this->call('StageTableSeeder');
        $this->call('ColorTableSeeder');

        $this->command->info('All tables seeded!');
	}

}