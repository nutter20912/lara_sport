<?php

namespace App\Services\Sport;

use App\Exceptions\BadRequestException;
use App\Models\SportType;

class SportTypeService
{
    /**
     * 建立體育場別
     *
     * @param int $name
     */
    public function create($name): SportType
    {
        if (!$name) {
            throw new BadRequestException('Invalid name.', 10012);
        }

        if (SportType::where('name', $name)->first()) {
            throw new BadRequestException('Duplicate entry.', 10013);
        }

        $sportType = new SportType();
        $sportType->name = $name;
        $sportType->save();

        return $sportType;
    }
}
