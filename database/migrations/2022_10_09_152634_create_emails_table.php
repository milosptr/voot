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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->text('remark')->nullable();
            $table->string('class')->nullable();
            $table->string('order_id')->nullable()->references('id')->on('orders');
            $table->integer('type')->default(1);
            $table->datetime('sent_at')->nullable();
            $table->integer('tries')->default(0);
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
        Schema::dropIfExists('emails');
    }
};
