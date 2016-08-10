<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_commisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('charity_id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->decimal('amount');
            $table->text('name');
            $table->text('email');
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
        Schema::drop('charity_commisions');
    }
}
