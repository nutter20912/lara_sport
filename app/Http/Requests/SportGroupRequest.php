<?php

namespace App\Http\Requests;

use App\Rules\NotZeroNumeric;
use Illuminate\Foundation\Http\FormRequest;

class SportGroupRequest extends FormRequest
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
            'sport_type_id' => [new NotZeroNumeric],
            'sport_play_id' => [new NotZeroNumeric],
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
                    'sport_category_id',
                    'sport_type_id',
                    'sport_play_id',
                ],
                'extra' => [
                    'sport_category_id' => [
                        'required',
                    ],
                    'sport_type_id' => [
                        'required',
                    ],
                    'sport_play_id' => [
                        'required',
                    ],
                ],
            ],
        ];
    }
}
