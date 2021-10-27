<?php

namespace App\Http\Requests;

use App\Rules\NotZeroNumeric;
use Illuminate\Foundation\Http\FormRequest;

class SportLeagueRequest extends FormRequest
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
            'name' => ['max:10'],
            'sport_category_id' =>  [new NotZeroNumeric],
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
                    'sport_category_id',
                ],
                'extra' => [
                    'name' => [
                        'required',
                    ],
                    'sport_category_id' => [
                        'required',
                    ],
                ],
            ],
        ];
    }
}
