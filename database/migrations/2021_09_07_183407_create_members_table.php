<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('surname',50);
            $table->string('ci',15)->unique();
            $table->string('gender',10);
            $table->string('marital_status',10);
            $table->string('address',100);
            $table->string('status',15);
            $table->string('phone',15);
            $table->string('date_of_birth',15);
           // $table->string('image',150);
            $table->string('post',150);//cargo
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
        Schema::dropIfExists('members');
    }
}
