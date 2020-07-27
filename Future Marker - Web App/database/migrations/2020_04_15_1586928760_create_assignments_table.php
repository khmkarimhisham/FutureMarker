<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
	public function up()
	{
		Schema::create('assignments', function (Blueprint $table) {

			$table->id();
			$table->unsignedBigInteger('course_id');
			$table->string('assignment_title');
			$table->string('assignment_desc_dir');
			$table->integer('full_grade');
			$table->integer('compilation_grade');
			$table->integer('style_grade');
			$table->integer('dynamic_test_grade');
			$table->integer('feature_test_grade');
			$table->datetime('assignment_deadline');
			$table->string('assignment_model_ans')->nullable();
			$table->string('assignment_ma_main');
			$table->string('attachments_dir')->nullable();
			$table->integer('assignment_repetition');
			$table->timestamps();
			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	public function down()
	{
		Schema::dropIfExists('assignments');
	}
}
