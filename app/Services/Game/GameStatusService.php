<?php

namespace App\Services\Game;

use App\Exceptions\BadRequestException;
use App\Models\Game;
use App\Models\GameStatus;
use App\Models\SportGroup;
use Illuminate\Support\Arr;

class GameStatusService
{
    /**
     * 建立遊戲場次狀態
     *
     * @param int $gameId
     * @param int $sportGroupId
     * @param array $options
     * @return App\Models\GameStatus
     */
    public function create(
        int $gameId,
        int $sportGroupId,
        array $options,
    ): GameStatus {
        [$visibled, $enabled] = Arr::list($options, ['visibled', 'enabled']);

        if (!$game = Game::find($gameId)) {
            throw new BadRequestException('game not found.', 20001);
        }

        if (!$sportGroup = SportGroup::find($sportGroupId)) {
            throw new BadRequestException('SportGroup not found.', 20001);
        }

        $criteria = [
            'game_id' => $gameId,
            'sport_group_id' => $sportGroupId,
        ];

        if (GameStatus::where($criteria)->first()) {
            throw new BadRequestException('Duplicate entry.', 10038);
        }

        $gameStatus = new GameStatus();
        $gameStatus->visibled = $visibled ?? true;
        $gameStatus->enabled = $enabled ?? true;
        $gameStatus->game()->associate($game);
        $gameStatus->sportGroup()->associate($sportGroup);
        $gameStatus->save();

        return $gameStatus;
    }
}
