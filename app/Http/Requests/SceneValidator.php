<?php

namespace App\Http\Requests;

use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Route;


trait SceneValidator
{
    /**
     * 場景規則
     */
    protected $sceneRules = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 回傳場景規則
     *
     * @return array
     */
    public function getSceneRules()
    {
        return array_map(function($rules) {
            return implode('|' , $rules);
        }, $this->sceneRules);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($scene = $this->getScene()) {
            ['required' => $required, 'rules' => $rules] = $scene;
            $ruleList = $this->ruleList();

            return $this
                ->handleRequired($required)
                ->handleRules($rules, $ruleList)
                ->getSceneRules();
        }
    }

    /**
     * 取得場景驗證規則
     *
     * @return array
     */
    public function getScene()
    {
        $method = Route::getCurrentRoute()->getActionMethod();

        return $this->scenes()[$method] ?? null;
    }

    /**
     * 處理必填欄位
     *
     * @return self
     */
    public function handleRequired($required)
    {
        $this->sceneRules = array_fill_keys($required, ['required']);

        return $this;
    }

    /**
     * 處理驗證規則
     *
     * @return self
     */
    public function handleRules($rules, $ruleList): self
    {
        foreach ($rules as $rule) {
            if (!isset($ruleList[$rule])) {
                throw new \RuntimeException('unknown rule.', 1234);
            }

            $this->sceneRules[$rule][] = $ruleList[$rule];
        }

        return $this;
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first(), 10002);
        }
    }
}
