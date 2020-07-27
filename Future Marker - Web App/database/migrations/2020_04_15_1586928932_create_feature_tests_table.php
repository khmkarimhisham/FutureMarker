<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureTestsTable extends Migration
{
    public function up()
    {
        Schema::create('feature_tests', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->string('test_name');
            $table->string('regex');
            $table->integer('repetition');
            $table->timestamps();
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_tests');
    }
}
