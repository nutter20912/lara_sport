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
    public function getSceneRules(): array
    {
        return $this->sceneRules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($scene = $this->getScene()) {
            ['attributes' => $attributes, 'extra' => $extra] = $scene;

            return $this
                ->handleRules($attributes)
                ->handleExtra($extra)
                ->getSceneRules();
        }
    }

    /**
     * 取得場景驗證規則
     *
     * @return array
     */
    public function getScene(): array
    {
        $method = Route::getCurrentRoute()->getActionMethod();

        return $this->scenes()[$method] ?? null;
    }

    /**
     * 處理驗證規則
     *
     * @param array $attributes
     * @return self
     */
    public function handleRules($attributes): self
    {
        foreach ($attributes as $attribute) {
            if (!$this->isRuleExist($attribute)) {
                throw new \RuntimeException('unknown attribute.', 1234);
            }

            $this->sceneRules[$attribute] = $this->ruleList()[$attribute];
        }

        return $this;
    }

    /**
     * 規則是否存在
     *
     * @param array $key
     * @return bool
     */
    public function isRuleExist($key)
    {
        return isset($this->ruleList()[$key]);
    }

    /**
     * 處理額外規則
     *
     * @param array $extra
     * @return self
     */
    public function handleExtra($extra): self
    {
        foreach ($extra as $attribute => $rule) {
            if (!$this->isRuleExist($attribute)) {
                throw new \RuntimeException('unknown extra attribute.', 1234);
            }

            $this->sceneRules[$attribute] = array_merge(
                $this->sceneRules[$attribute] ?? [],
                $rule,
            );
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
