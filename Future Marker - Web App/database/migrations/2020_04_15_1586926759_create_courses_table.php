<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {

            $table->id();
            $table->string('course_access_code');
            $table->string('course_name');
            $table->text('course_desc');
            $table->string('course_image');
            $table->string('course_material_dir');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
