<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SportCategoryRequest extends FormRequest
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
                ],
                'extra' => [
                    'name' => [
                        'required',
                    ],
                ],
            ],
        ];
    }
}
