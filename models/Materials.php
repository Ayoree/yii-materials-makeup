<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Materials extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const types = [
        'Книга',
        'Статья',
        'Видео',
        'Сайт/Блог',
        'Подборка',
        'Ключевые идеи книги',
    ];

    public function attributeLabels() {
        return [
            'id' => 'id',
            'type' => 'Тип',
            'category' => 'Категория',
            'name' => 'Название',
            'author' => 'Автор',
            'description' => 'Описание',
        ];
    }

    public function rules() {
        return [
            [['name', 'author', 'description'], 'trim'],
            [['type', 'category', 'name'], 'required'],
            [['author', 'description'], 'string', 'length' => [0, 65535]],
            [['type', 'category'], 'number','min' => 1],
            ['category', 'in', 'range' => Categories::find()->select('id')->asArray()->column()],
            ['name', 'string', 'length' => [1, 63]],
            ['type', 'number', 'max' => 6],
            ['id', 'required', 'on' => self::SCENARIO_UPDATE],
            ['id', 'number', 'min' => 1, 'on' => self::SCENARIO_UPDATE],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['type', 'category', 'name', 'author', 'description'];
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'type', 'category', 'name', 'author', 'description'];
        return $scenarios;
    }
    
    public function getCategory() {
        return $this->hasOne(Categories::class, ['id' => 'category']);
    }
    public function getCategoryName() {
        return $this->getCategory()->one()->name;
    }
    public function getLinks() {
        return $this->hasMany(MaterialLink::class, ['material_id' => 'id']);
    }
    public function getTags() {
        return $this->hasMany(Tags::class, ['id' => 'tag_id'])
            ->viaTable('material_tag', ['material_id' => 'id']);
    }
    public function getOtherTags() {
        return Tags::find()->where(['not', [
            'id' => $this->getTags()->select('id')->asArray()->all()
            ]
        ]);
    }
    public function getType() {
        return Materials::types[$this->type - 1];
    }

    public static function getMaterialsBySearch() {
        // обычный поиск
        if ($src = Yii::$app->request->get('src')) { 
            return Materials::find()
            ->innerJoin('categories', 'materials.category = categories.id')
            ->Where(['or', 
                ['like', 'materials.name', $src],
                ['like', 'materials.description', $src],
                ['like', 'materials.author', $src],
                ['like', 'categories.name', $src],
            ]);
        }
        // по тегу
        else if ($tag = Yii::$app->request->get('tag')) {
            if ($tag = Tags::findOne(['name' => $tag]))
                return $tag->getMaterials();
            return Materials::find()->where(['id' => 0]);
        }
        // без поиска
        else {
            return Materials::find();
        }
    }

}
