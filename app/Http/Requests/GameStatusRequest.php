<?php

namespace App\Http\Requests;

use App\Rules\NotZeroNumeric;
use Illuminate\Foundation\Http\FormRequest;

class GameStatusRequest extends FormRequest
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
            'sport_group_id' => [new NotZeroNumeric],
            'visibled' => ['boolean'],
            'enabled' => ['boolean'],
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
                    'sport_group_id',
                    'visibled',
                    'enabled',
                ],
                'extra' => [
                    'sport_group_id' => [
                        'required',
                    ],
                ],
            ],
        ];
    }
}
