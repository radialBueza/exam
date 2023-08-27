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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('question')->nullable();
            $table->string('question_file')->nullable();
            $table->string('a')->nullable();
            $table->string('a_file')->nullable();
            $table->string('b')->nullable();
            $table->string('b_file')->nullable();
            $table->string('c')->nullable();
            $table->string('c_file')->nullable();
            $table->string('d')->nullable();
            $table->string('d_file')->nullable();
            $table->enum('correct_answer', ['a', 'b', 'c', 'd']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
