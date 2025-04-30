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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // answer is 0 to 6
            $table->tinyInteger('num_games_play');
            $table->tinyInteger('hrs_play_mobile');
            $table->tinyInteger('hrs_play_console');
            $table->tinyInteger('hrs_play_pc');
            $table->tinyInteger('hrs_play_shooter');
            $table->tinyInteger('hrs_play_act_adv');
            $table->tinyInteger('hrs_play_sims');
            $table->tinyInteger('hrs_play_moba');
            $table->tinyInteger('hrs_play_sports');
            $table->tinyInteger('hrs_play_racing');
            $table->tinyInteger('hrs_play_strat');
            $table->tinyInteger('hrs_play_battle_royal');
            $table->tinyInteger('hrs_play_puzzle_plat');
            $table->tinyInteger('hrs_play_fighting');
            $table->tinyInteger('hrs_play_board');
            $table->boolean('is_gamer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
