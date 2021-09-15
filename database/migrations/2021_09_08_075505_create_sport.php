<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_category', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->comment('編號');
            $table->string('name')->comment('類別名稱');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');
        });

        DB::statement("ALTER TABLE `sport_category` comment '體育類別'");

        Schema::create('sport_type', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->comment('編號');
            $table->string('name')->comment('場別名稱');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');
        });

        DB::statement("ALTER TABLE `sport_type` comment '體育場別'");

        Schema::create('sport_play', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->comment('編號');
            $table->string('name')->comment('玩法名稱');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');
        });

        DB::statement("ALTER TABLE `sport_play` comment '體育玩法'");

        Schema::create('sport', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->tinyInteger('sport_category_id')->comment('體育類別編號');
            $table->tinyInteger('sport_type_id')->comment('體育場別編號');
            $table->tinyInteger('sport_play_id')->comment('體育玩法編號');
            $table->boolean('enable')->default(true)->comment('是否開放');
            $table->timestamp('created_at')->useCurrent()->comment('建立時間');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新時間');

            $table->unique([
                'sport_category_id',
                'sport_type_id',
                'sport_play_id'
            ]);
            $table->foreign('sport_type_id')->references('id')->on('sport_type');
            $table->foreign('sport_play_id')->references('id')->on('sport_play');
            $table->foreign('sport_category_id')->references('id')->on('sport_category');
        });

        DB::statement("ALTER TABLE `sport` comment '體育'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport');
        Schema::dropIfExists('sport_category');
        Schema::dropIfExists('sport_type');
        Schema::dropIfExists('sport_play');
    }
}
