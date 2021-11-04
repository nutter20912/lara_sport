<?php

namespace App\Services\Sport;

use App\Exceptions\BadRequestException;
use App\Models\SportCategory;
use App\Models\SportGroup;
use App\Models\SportPlay;
use App\Models\SportType;

class SportGroupService
{
    /**
     * 建立體育群組
     *
     * @param int $sportCategoryId
     * @param int $sportTypeId
     * @param int $sportPlayId
     */
    public function create(
        int $sportCategoryId,
        int $sportTypeId,
        int $sportPlayId,
    ): SportGroup {
        if (!$sportCategory = SportCategory::find($sportCategoryId)) {
            throw new BadRequestException('Sport Category not found', 10035);
        }

        if (!$sportType = SportType::find($sportTypeId)) {
            throw new BadRequestException('Sport Type not found', 10036);
        }

        if (!$sportPlay = SportPlay::find($sportPlayId)) {
            throw new BadRequestException('Sport Play not found', 10037);
        }

        $criteria = [
            'sport_category_id' => $sportCategoryId,
            'sport_type_id' => $sportTypeId,
            'sport_play_id' => $sportPlayId,
        ];

        if (SportGroup::where($criteria)->first()) {
            throw new BadRequestException('Duplicate entry.', 10038);
        }

        $sportGroup = new SportGroup();
        $sportGroup->sportCategory()->associate($sportCategory);
        $sportGroup->sportType()->associate($sportType);
        $sportGroup->sportPlay()->associate($sportPlay);
        $sportGroup->save();

        return $sportGroup;
    }
}
