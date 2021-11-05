<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economies', function (Blueprint $table) {
            $table->id();
            $table->text('description',150);
            $table->dateTime('date', $precision = 0);
            $table->float('income', 8, 2);
            $table->float('egress', 8, 2);
            $table->float('total', 8, 2);
            //Foranea
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('box_types')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            //Foranea miembros
            $table->unsignedBigInteger('member_id');
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
        Schema::dropIfExists('economies');
    }
}
