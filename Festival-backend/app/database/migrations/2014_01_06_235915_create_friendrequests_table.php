<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendrequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('friend_requests', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('from_id');
            $table->foreign('from_id')->references('friend1_id')->on('friends');
            $table->unsignedInteger('to_id');
            $table->foreign('to_id')->references('friend2_id')->on('friends');
            $table->string('status');
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
		Schema::drop('friendrequests');
	}

}
