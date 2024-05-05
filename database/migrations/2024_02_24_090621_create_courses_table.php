<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('expedient')->nullable();
            $table->string('certificatecode')->nullable();
            $table->integer('hours')->unsigned()->nullable();
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->longText('comments')->nullable();
            $table->integer('nstudents')->unsigned()->nullable(); //no admite negativos
            $table->enum('CoursesTypeEnum',['pendiente','preparando','encurso','finalizado','archivado'])
            ->default('pendiente');
            $table->enum('CoursesModoEnum',['teleformacion','bimodal','presencial'])->nullable();
            $table->enum('CoursesClassEnum',['ocupados','desempleados','mujeres', 'otros'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
