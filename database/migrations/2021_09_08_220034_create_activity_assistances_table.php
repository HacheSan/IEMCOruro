<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_assistances', function (Blueprint $table) {
            $table->primary(['activity_id', 'member_id']);
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('member_id');
            $table->dateTime('date', $precision = 0);
            
            //Antecendentes
            
            $table->foreign('activity_id')->references('id')->on('activities')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            //Person
            
            $table->foreign('member_id')->references('id')->on('members')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('activity_assistances');
    }
}
