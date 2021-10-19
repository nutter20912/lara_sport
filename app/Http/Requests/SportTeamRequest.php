<?php

namespace App\Http\Requests;

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
            'name' => 'max:10',
            'sport_league_id' => 'numeric|min:1',
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
                'required' => [
                    'name',
                    'sport_league_id',
                ],
                'rules' => [
                    'name',
                    'sport_league_id',
                ],
            ],
        ];
    }

}
