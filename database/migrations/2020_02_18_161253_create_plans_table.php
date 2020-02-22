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
            $table->string('symbol')->index();
            $table->string('name')->nullable();
            $table->string('side')->default('buy');
            $table->decimal('total', 12, 6);
            $table->integer('lever')->default(1);
            $table->string('period')->default('12h');
            $table->string('type')->default('pdf'); // pdf,break
            $table->decimal('keyPrice', 12, 6);
            $table->decimal('lowestPrice', 12, 6);
            $table->decimal('targetPrice', 12, 6);
            $table->decimal('breakevenPrice', 12, 6);
            $table->decimal('ticker', 12, 6);
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
