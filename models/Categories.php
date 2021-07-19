<?php

namespace app\models;
use yii\db\ActiveRecord;

class Categories extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function attributeLabels() {
        return [
            'id' => 'id',
            'name' => 'Название',
        ];
    }

    public function rules() {
        return [
            ['name', 'string', 'length' => [1, 63]],
            ['name', 'required'],
            ['name', 'trim'],
            ['id', 'required', 'on' => self::SCENARIO_UPDATE],
            ['id', 'number', 'min' => 1, 'on' => self::SCENARIO_UPDATE],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['name'];
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'name'];
        return $scenarios;
    }

    public function getMaterials() {
        return $this->hasMany(Materials::class, ['category' => 'id']);
    }
}
