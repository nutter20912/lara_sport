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

        Schema::table('sport', function (Blueprint $table) {
            $table->dropForeign(['sport_category_id']);
            $table->dropForeign(['sport_type_id']);
            $table->dropForeign(['sport_play_id']);
        });

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

        Schema::table('sport_league', function (Blueprint $table) {
            $table->dropForeign(['sport_category_id']);
        });

        Schema::table('sport_team', function (Blueprint $table) {
            $table->dropForeign(['sport_league_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sport', function (Blueprint $table) {
            $table->foreign('sport_category_id')->references('id')->on('sport_category');
            $table->foreign('sport_type_id')->references('id')->on('sport_type');
            $table->foreign('sport_play_id')->references('id')->on('sport_play');
        });

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

        Schema::table('sport_league', function (Blueprint $table) {
            $table->foreign('sport_category_id')->references('id')->on('sport_category');
        });

        Schema::table('sport_team', function (Blueprint $table) {
            $table->foreign('sport_league_id')->references('id')->on('sport_league');
        });
    }
}
