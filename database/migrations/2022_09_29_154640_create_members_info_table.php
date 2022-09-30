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
        Schema::create('members_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->reference('id')->on('users');
            $table->string('name');
            $table->string('shoe_size')->nullable();
            $table->string('glove_size')->nullable();
            $table->string('hat_size')->nullable();
            $table->string('headset_size')->nullable();
            $table->string('jacket_size')->nullable();
            $table->string('vest_size')->nullable();
            $table->string('suit_size')->nullable();
            $table->string('pants_size')->nullable();
            $table->string('shirt_size')->nullable();
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
        Schema::dropIfExists('members_info');
    }
};
