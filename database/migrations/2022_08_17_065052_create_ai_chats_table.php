<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_chats', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->foreignId('channel_id')->references('id')->on('channels');
            $table->foreignId('bot_id')->nullable()->references('id')->on('ai_bots');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('ai_chats');
    }
};
