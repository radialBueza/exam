<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('account_type', ['admin', 'teacher', 'advisor', 'student'])->nullable();
            $table->foreignId('department_id')->nullable()->default(null)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->default(null)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('take_survey')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
};
