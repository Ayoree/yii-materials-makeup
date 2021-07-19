<?php

namespace app\controllers;

use yii\web\Controller;

class ListController extends Controller
{
    public function actionIndex()    { return $this->render('material'); }
    public function actionMaterial() { return $this->render('material'); }
    public function actionTag()      { return $this->render('tag'); }
    public function actionCategory() { return $this->render('category'); }

}
