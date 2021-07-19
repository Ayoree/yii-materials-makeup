<?php

namespace app\models;
use yii\db\ActiveRecord;

class MaterialTag extends ActiveRecord
{
    public function rules() {
        return [
            [['material_id', 'tag_id'], 'required'],
            [['material_id', 'tag_id'], 'number', 'min' => 1],
            ['material_id', 'in', 'range' => Materials::find()->select('id')->asArray()->column()],
            ['tag_id', 'in', 'range' => Tags::find()->select('id')->asArray()->column()],
        ];
    }

    public function getMaterals() {
        return $this->hasMany(Materials::class, ['id' => 'material_id']);
    }
    public function getTags() {
        return $this->hasMany(Tags::class, ['id' => 'tag_id']);
    }
}
