<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('market');
            $table->string('name');
            $table->string('symbol');
            $table->string('period');
            $table->decimal('total',14,6)->default(0);
            $table->string('unit');
            $table->integer('lever')->unsigned()->default(1);
            $table->text('remark')->nullable();
            $table->string('status')->default('todo');// 待处理todo、在分析doing、已完成done
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
        Schema::dropIfExists('asks');
    }
}
