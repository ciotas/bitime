<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('market')->default('crypto');
            $table->string('symbol');
            $table->string('name')->nullable();
            $table->float('total');
            $table->integer('lever')->default(1);
            $table->string('period')->default('12h');
            $table->string('type')->default('pdf'); // pdf,break
            $table->float('keyPrice');
            $table->float('lowestPrice');
            $table->float('targetPrice');
            $table->float('breakevenPrice');
            $table->float('ticker');
            $table->integer('expectRate')->default(3);
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
        Schema::dropIfExists('plans');
    }
}
