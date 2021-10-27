<?php

namespace App\Services\Sport;

use App\Exceptions\BadRequestException;
use App\Models\SportCategory;
use App\Models\SportLeague;

class SportLeagueService
{
    /**
     * 建立體育聯盟
     *
     * @param int $name
     * @param int $sportCategoryId
     */
    public function create($name, $sportCategoryId): SportLeague
    {
        if (!SportCategory::find($sportCategoryId)) {
            throw new BadRequestException('Sport Category not found.', 10003);
        }

        $criteria = [
            'name' => $name,
            'sport_category_id' => $sportCategoryId,
        ];

        if (SportLeague::where($criteria)->first()) {
            throw new BadRequestException('Duplicate entry.', 10003);
        }

        $sportLeague = SportLeague::create($criteria);
        $sportLeague->save();

        return $sportLeague;
    }
}
