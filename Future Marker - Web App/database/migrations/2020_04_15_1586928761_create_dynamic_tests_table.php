<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicTestsTable extends Migration
{
    public function up()
    {
        Schema::create('dynamic_tests', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->text('input')->nullable();
            $table->text('output');
            $table->string('test_attachments')->nullable();
            $table->boolean('hidden');
            $table->timestamps();
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('dynamic_tests');
    }
}
