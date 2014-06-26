<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lineups', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('artist', 45);
            $table->date('performanceday');
            $table->dateTime('performancestart');
            $table->dateTime('performanceend');
            $table->unsignedInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->unsignedInteger('festival_id');
            $table->foreign('festival_id')->references('id')->on('festivals');
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
		Schema::drop('lineups');
	}

}
