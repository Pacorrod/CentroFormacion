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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dni')->nullable();
            $table->char('cp',5)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('disable')->default(false);
            $table->string('grade')->nullable();
            $table->string('studentype')->nullable();
            $table->enum('StudentsTypeEnum',['ocupado','desempleado','funcionario'])->nullable();
            $table->string('dnipdf')->nullable();
            $table->longText('comments')->nullable();
            $table->boolean('removed')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
