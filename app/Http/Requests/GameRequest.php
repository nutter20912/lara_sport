<?php

namespace App\Http\Requests;

use App\Rules\NotZeroNumeric;
use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    use SceneValidator;

    public $stopOnFirstFailure = true;

    /**
     * 驗證規則列表
     *
     * @return array
     */
    public function ruleList()
    {
        return [
            'sport_category_id' => [new NotZeroNumeric],
            'sport_league_id' => [new NotZeroNumeric],
            'main_team_id' => [new NotZeroNumeric],
            'visit_team_id' => [new NotZeroNumeric],
        ];
    }

    /**
     * 場景驗證規則
     *
     * @return array
     */
    public function scenes()
    {
        return [
            'post' => [
                'attributes' => [
                    'sport_category_id',
                    'sport_league_id',
                    'main_team_id',
                    'visit_team_id',
                ],
                'extra' => [
                    'sport_category_id' => [
                        'required',
                    ],
                    'sport_league_id' => [
                        'required',
                    ],
                    'main_team_id' => [
                        'required',
                    ],
                    'visit_team_id' => [
                        'required',
                    ],
                ],
            ],
        ];
    }
}
