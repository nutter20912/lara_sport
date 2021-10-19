<?php

namespace App\Http\Requests;

use App\Exceptions\BadRequestException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class SportLeagueRequest extends FormRequest
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
            'sport_category_id' => 'numeric',
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
                    'sport_category_id',
                ],
                'rules' => [
                    'name',
                    'sport_category_id',
                ],
            ],
        ];
    }

}
