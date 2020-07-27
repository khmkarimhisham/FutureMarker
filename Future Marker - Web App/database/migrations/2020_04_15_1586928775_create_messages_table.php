<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->datetime('message_read_time')->nullable();;
            $table->text('message_content');
            $table->string('attachments_dir');
            $table->timestamps();
            $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
