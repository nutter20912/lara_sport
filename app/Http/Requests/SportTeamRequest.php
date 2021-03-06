<?php

namespace App\Http\Requests;

use App\Rules\NotZeroNumeric;
use Illuminate\Foundation\Http\FormRequest;

class SportTeamRequest extends FormRequest
{
    use SceneValidator;

    /**
     * 驗證規則列表
     *
     * @return array
     */
    public function ruleList()
    {
        return [
            'name' => ['max:10'],
            'sport_league_id' => [new NotZeroNumeric],
        ];
    }

    /**
     * 場景驗證規則
     *
     * @return array
     */
    public function scenes(): array
    {
        return [
            'post' => [
                'attributes' => [
                    'name',
                    'sport_league_id',
                ],
                'extra' => [
                    'name' => [
                        'required',
                    ],
                    'sport_league_id' => [
                        'required',
                    ],
                ],
            ],
        ];
    }
}
