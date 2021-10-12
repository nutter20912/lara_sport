<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('game', function (Blueprint $table) {
            $table->dropForeign(['main_team_id']);
            $table->dropForeign(['visit_team_id']);
        });

        Schema::table('game_result', function (Blueprint $table) {
            $table->dropForeign(['sport_id']);
            $table->dropForeign(['game_id']);
        });

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->dropForeign(['sport_id']);
            $table->dropForeign(['game_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->foreign('sport_id')->references('id')->on('sport');
            $table->foreign('game_id')->references('id')->on('game');
        });

        Schema::table('game_result', function (Blueprint $table) {
            $table->foreign('sport_id')->references('id')->on('sport');
            $table->foreign('game_id')->references('id')->on('game');
        });

        Schema::table('game', function (Blueprint $table) {
            $table->foreign('main_team_id')->references('id')->on('sport_team');
            $table->foreign('visit_team_id')->references('id')->on('sport_team');
        });
    }
}
