<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Materials;
use app\models\Categories;
use app\models\MaterialLink;
use app\models\MaterialTag;
use app\models\Tags;
use yii\helpers\Url;

class DeleteController extends Controller
{
    public function actionIndex() { return $this->redirect('index.php?r=list'); }

    public function actionMaterial() {
        $id = intval(Yii::$app->request->get('id'));
        if ($id > 0) {
            if ($model = Materials::findOne($id)) {
                MaterialTag::deleteAll(['material_id' => $id]);
                MaterialLink::deleteAll(['material_id' => $id]);
                $model->delete();
            }
        }
        return $this->redirect(Url::toRoute(['list/material']));
    }

    public function actionCategory() {
        $id = intval(Yii::$app->request->get('id'));
        if ($id > 0) {
            if ($model = Categories::findOne($id)) {
                $model->delete();
                Materials::deleteAll(['category' => $id]);
            }
        }
        return $this->redirect(Url::toRoute(['list/category']));
    }

    public function actionTag() {
        $id = intval(Yii::$app->request->get('id'));
        if ($id > 0) {
            if ($model = Tags::findOne($id)) {
                $model->delete();
                MaterialTag::deleteAll(['tag_id' => $id]);
            }
        }
        return $this->redirect(Url::toRoute(['list/tag']));
    }

    public function actionTagFromMaterial() {
        $tag = intval(Yii::$app->request->get('tag_id'));
        $mat = intval(Yii::$app->request->get('material_id'));
        if ($tag > 0 && $mat > 0) {
            MaterialTag::deleteAll(['and', ['tag_id' => $tag, 'material_id' => $mat]]);
        }
        return $this->redirect(Url::toRoute(['site/material', 'id' => $mat]));
    }

    public function actionLink() {
        $id = intval(Yii::$app->request->get('id'));
        if ($id > 0) {
            MaterialLink::deleteAll(['id' => $id]);
        }
        return $this->redirect(Url::toRoute(['site/material', 'id' => Yii::$app->request->get('material_id')]));
    }
}