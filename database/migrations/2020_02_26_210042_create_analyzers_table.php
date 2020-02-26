<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyzersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyzers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ask_id')->index();
            $table->foreign('ask_id')->references('id')->on('asks')->onDelete('cascade');
            $table->unsignedBigInteger('plan_id')->index()->nullable();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->text('body');
            $table->smallInteger('use_plan')->default(0);
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
        Schema::dropIfExists('analyzers');
    }
}
