<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSportName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_result', function (Blueprint $table) {
            $table->renameColumn('sport_id', 'sport_group_id');
        });

        Schema::table('game_result', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_group_id')
                ->comment('體育群組編號')
                ->change();
        });

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->renameColumn('sport_id', 'sport_group_id');
        });

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_group_id')
                ->comment('體育群組編號')
                ->change();
        });

        Schema::rename('sport', 'sport_group');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('sport_group', 'sport');

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->renameColumn('sport_group_id', 'sport_id');
        });

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_id')
                ->comment('體育編號')
                ->change();
        });

        Schema::table('game_result', function (Blueprint $table) {
            $table->renameColumn('sport_group_id', 'sport_id');
        });

        Schema::table('game_result', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_id')
                ->comment('體育編號')
                ->change();
        });
    }
}
