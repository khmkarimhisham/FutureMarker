<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedAssignmentsTable extends Migration
{
	public function up()
	{
		Schema::create('finished_assignments', function (Blueprint $table) {

			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('assignment_id');
			$table->string('assignment_dir');
			$table->string('assignment_main');
			$table->integer('compilation_grade');
			$table->text('compilation_feedback');
			$table->integer('style_grade');
			$table->text('style_feedback');
			$table->integer('dynamic_test_grade');
			$table->text('dynamic_test_feedback');
			$table->integer('feature_test_grade');
			$table->text('feature_test_feedback');
			$table->boolean('assignment_alert');
			$table->timestamps();
			$table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	public function down()
	{
		Schema::dropIfExists('finished_assignments');
	}
}
