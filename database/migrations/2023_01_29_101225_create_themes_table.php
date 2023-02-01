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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->default("Qo`shimcha ma`lumot yo`q");
            $table->integer('specialty_id')->default(0);
            $table->integer('level_code')->default(0);
            $table->bigInteger('student_id')->unsigned()->default(0);
            $table->string('student_name')->nullable();
            $table->string('group_name')->nullable();
            $table->bigInteger('teacher_id')->unsigned()->default(0);
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
        Schema::dropIfExists('themes');
    }
};
