<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLeagueAndTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_league', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->tinyInteger('sport_category_id')->comment('體育類別編號');
            $table->string('name')->comment('聯盟名稱');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');

            $table->unique([
                'sport_category_id',
                'name',
            ]);
            $table->foreign('sport_category_id')->references('id')->on('sport_category');
        });

        DB::statement("ALTER TABLE `sport_league` comment '體育聯盟'");

        Schema::create('sport_team', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('sport_league_id')->comment('體育聯盟編號');
            $table->string('name')->comment('隊伍名稱');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');

            $table->unique([
                'sport_league_id',
                'name',
            ]);
            $table->foreign('sport_league_id')->references('id')->on('sport_league');
        });

        DB::statement("ALTER TABLE `sport_team` comment '體育隊伍'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport_team');
        Schema::dropIfExists('sport_league');
    }
}
