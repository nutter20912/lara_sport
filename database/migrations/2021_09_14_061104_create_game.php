<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('main_team_id')->comment('主隊編號');
            $table->unsignedBigInteger('visit_team_id')->comment('客隊編號');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');

            $table->foreign('main_team_id')->references('id')->on('sport_team');
            $table->foreign('visit_team_id')->references('id')->on('sport_team');
        });

        DB::statement("ALTER TABLE `game` comment '體育場次'");

        Schema::create('game_result', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('sport_id')->comment('體育編號');
            $table->unsignedBigInteger('game_id')->comment('場次編號');
            $table->integer('main_score')->comment('主隊分數');
            $table->integer('visit_score')->comment('客隊分數');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');

            $table->foreign('sport_id')->references('id')->on('sport');
            $table->foreign('game_id')->references('id')->on('game');
        });

        DB::statement("ALTER TABLE `game_result` comment '場次賽果'");

        Schema::create('game_bet_status', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('sport_id')->comment('體育編號');
            $table->unsignedBigInteger('game_id')->comment('場次編號');
            $table->boolean('visible')->default(true)->comment('是否顯示');
            $table->boolean('enable')->default(true)->comment('是否可投注');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');

            $table->foreign('sport_id')->references('id')->on('sport');
            $table->foreign('game_id')->references('id')->on('game');
        });

        DB::statement("ALTER TABLE `game_bet_status` comment '場次狀態'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_result');
        Schema::dropIfExists('game_bet_status');
        Schema::dropIfExists('game');
    }
}
