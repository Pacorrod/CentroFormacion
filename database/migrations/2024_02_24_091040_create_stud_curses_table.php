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
        Schema::create('stud_curses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courses_id')
            ->constrained('courses')
            ->cascadeOnDelete();
            $table->foreignId('students_id')
            ->constrained('students')
            ->cascadeOnDelete();
            $table->boolean('documentation')->default(false);
            $table->string('comments')->nullable();
            $table->boolean('disable')->default(false);
            $table->date('datedisable')->nullable();
            $table->string('disablecomments')->nullable();
            $table->boolean('subvencionable')->default(false);
            $table->decimal('nota',10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stud_curses');
    }
};
