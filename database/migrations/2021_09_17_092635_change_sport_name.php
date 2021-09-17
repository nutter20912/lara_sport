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
        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_id')
                ->comment('體育群組編號')
                ->change();

            $table->dropForeign(['sport_id']);
        });

        Schema::rename('sport', 'sport_group');

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->renameColumn('sport_id', 'sport_group_id');

            $table->foreign('sport_group_id')->references('id')->on('sport_group');
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
            $table->unsignedBigInteger('sport_group_id')
                ->comment('體育編號')
                ->change();

            $table->dropForeign(['sport_group_id']);
        });

        Schema::rename('sport_group', 'sport');

        Schema::table('game_bet_status', function (Blueprint $table) {
            $table->renameColumn('sport_group_id', 'sport_id');

            $table->foreign('sport_id')->references('id')->on('sport');
        });
    }
}
