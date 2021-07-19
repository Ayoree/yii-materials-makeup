<?php

namespace app\controllers;

use app\models\MaterialLink;
use Yii;
use app\models\Materials;
use app\models\MaterialTag;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionMaterial() {
        $id = intval(Yii::$app->request->get('id'));
        if (!$material = Materials::findOne($id)) return $this->redirect('index.php?r=list');
        $tag_model = new MaterialTag();
        $link_model = new MaterialLink();
        return $this->render('material', compact('material', 'tag_model', 'link_model'));
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
