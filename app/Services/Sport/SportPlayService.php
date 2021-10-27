<?php

namespace App\Services\Sport;

use App\Exceptions\BadRequestException;
use App\Models\SportPlay;

class SportPlayService
{
    /**
     * 建立體育玩法
     *
     * @param int $name
     */
    public function create($name): SportPlay
    {
        if (!$name) {
            throw new BadRequestException('Invalid name.', 10022);
        }

        if (SportPlay::where('name', $name)->first()) {
            throw new BadRequestException('Duplicate entry.', 10023);
        }

        $sportPlay = new SportPlay();
        $sportPlay->name = $name;
        $sportPlay->save();

        return $sportPlay;
    }
}
