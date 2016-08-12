<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submissions', function(Blueprint $table) {
				$table->increments('id');
				$table->string('user_id');
				$table->enum('status',['pending','approved','diapproved']);
				$table->integer('department_id');
				$table->integer('section_id');
				$table->date('date');
				$table->time('time');
				$table->integer('duration');
				$table->text('task');
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
		//
	}

}
