<?php

namespace App\Services\Game;

use App\Models\SportCategory;
use App\Exceptions\BadRequestException;
use App\Models\Game;
use App\Repositories\SportLeagueRepository;
use App\Repositories\SportTeamRepository;

class GameService
{
    private SportLeagueRepository $sportLeagueRepository;

    private SportTeamRepository $sportTeamRepository;

    public function __construct(
        SportLeagueRepository $sportLeagueRepository,
        SportTeamRepository $sportTeamRepository,
    ) {
        $this->sportLeagueRepository = $sportLeagueRepository;
        $this->sportTeamRepository = $sportTeamRepository;
    }

    /**
     * 建立遊戲場次
     *
     * @param int $id
     * @param int $sportCategoryId
     * @param int $sportLeagueId
     * @param int $mainTeamId
     * @param int $visitTeamId
     */
    public function create(
        $id,
        $sportCategoryId,
        $sportLeagueId,
        $mainTeamId,
        $visitTeamId
    ): Game {
        if ($mainTeamId == $visitTeamId) {
            throw new BadRequestException('same Team.', 20001);
        }

        if (Game::find($id)) {
            throw new BadRequestException('Duplicate entry.', 20001);
        }

        if (!$sportCategory = SportCategory::find($sportCategoryId)) {
            throw new BadRequestException('sport category not found', 20001);
        }

        $sportLeague = $this->sportLeagueRepository
            ->getLeague($sportLeagueId, $sportCategoryId);

        if (!$sportLeague) {
            throw new BadRequestException('sport league not found', 20001);
        }

        $mainTeam = $this->sportTeamRepository
            ->getTeam($mainTeamId, $sportLeagueId);

        if (!$mainTeam) {
            throw new BadRequestException('SportMainTeam not found', 20001);
        }

        $visitTeam = $this->sportTeamRepository
            ->getTeam($visitTeamId, $sportLeagueId);

        if (!$visitTeam) {
            throw new BadRequestException('sportVisitTeam not found', 20001);
        }

        $game = new Game();
        $game->id = $id;
        $game->sportCategory()->associate($sportCategory);
        $game->sportLeague()->associate($sportLeague);
        $game->mainTeam()->associate($mainTeam);
        $game->visitTeam()->associate($visitTeam);
        $game->save();

        return $game;
    }
}
