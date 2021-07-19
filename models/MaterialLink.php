<?php

namespace app\models;
use yii\db\ActiveRecord;

class MaterialLink extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function rules() {
        return [/*
            [['material_id', 'link_url'], 'required'],
            ['material_id', 'number', 'min' => 1],
            ['material_id', 'in', 'range' => Materials::find()->select('id')->asArray()->column()],
            ['link_title', 'string', 'length' => [1, 63]],
            ['link_url', 'string', 'length' => [1, 127]],
            ['link_url', 'url'],
            ['id', 'required', 'on' => self::SCENARIO_UPDATE],
            ['id', 'number', 'min' => 1, 'on' => self::SCENARIO_UPDATE],
            */
            [['material_id', 'link_url', 'link_title', 'id'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'id',
            'material_id' => 'material_id',
            'link_title' => 'Подпись',
            'link_url' => 'Ссылка',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['material_id', 'link_title', 'link_url'];
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'material_id', 'link_title', 'link_url'];
        return $scenarios;
    }

    public function getMateral() {
        return $this->hasOne(Materials::class, ['id' => 'material_id']);
    }
}
