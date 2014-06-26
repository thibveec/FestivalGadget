<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFestivalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('festivals', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name', 55);
            $table->string('genre', 55);
            $table->date('festivalstart');
            $table->date('festivalend');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('festivals');
	}

}
