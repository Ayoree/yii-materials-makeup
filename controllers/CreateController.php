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

class CreateController extends Controller
{

    public function actionIndex() {
        return $this->actionMaterial();
    }
    public function actionMaterial() {
        $model = new Materials();
        $model->setScenario(Materials::SCENARIO_CREATE);

        $request = Yii::$app->request;

        // если get('id') не равен null тогда изменяем материал с этим id
        if ($request->get('id') != null && intval($request->get('id')) > 0) {
            if ($model = Materials::findOne($request->get('id'))) {
                $model->setScenario(Materials::SCENARIO_UPDATE);
            }
            else {
                $model = new Materials();
                $model->setScenario(Materials::SCENARIO_CREATE);
            }
        }

        // взаимодействие с БД
        if ($request->isPost) {
            if ($model->load($request->post())) {
                if ($model->save()) return $this->redirect(Url::toRoute(['list/material']));
            }
        }
        
        $action = $model->getScenario() == Materials::SCENARIO_CREATE ? 'Добавить' : 'Изменить';
        $this->view->title = "$action материал";
        return $this->render('material', compact('model', 'action'));
    }

    public function actionTag() {
        $model = new Tags();
        $model->setScenario(Tags::SCENARIO_CREATE);

        $request = Yii::$app->request;

        // если get('id') не равен null тогда изменяем тег с этим id
        if ($request->get('id') != null && intval($request->get('id')) > 0) {
            if ($model = Tags::findOne($request->get('id'))) {
                $model->setScenario(Tags::SCENARIO_UPDATE);
            }
            else {
                $model = new Tags();
                $model->setScenario(Tags::SCENARIO_CREATE);
            }
        }

        // взаимодействие с БД
        if ($request->isPost) {
            if ($model->load($request->post())) {
                if ($model->save()) return $this->redirect(Url::toRoute(['list/tag']));
            }
        }

        $action = $model->getScenario() == Tags::SCENARIO_CREATE ? 'Добавить' : 'Изменить';
        $this->view->title = "$action тег";
        return $this->render('tag', compact('model', 'action'));
    }

    public function actionCategory() {
        $model = new Categories();
        $model->setScenario(Categories::SCENARIO_CREATE);

        $request = Yii::$app->request;

        // если get('id') не равен null тогда изменяем категорию с этим id
        if ($request->get('id') != null && intval($request->get('id')) > 0) {
            if ($model = Categories::findOne($request->get('id'))) {
                $model->setScenario(Categories::SCENARIO_UPDATE);
            }
            else {
                $model = new Categories();
                $model->setScenario(Categories::SCENARIO_CREATE);
            }
        }

        // взаимодействие с БД
        if ($request->isPost) {
            if ($model->load($request->post())) {
                if ($model->save()) return $this->redirect(Url::toRoute(['list/category']));
            }
        }

        $action = $model->getScenario() == Categories::SCENARIO_CREATE ? 'Добавить' : 'Изменить';
        $this->view->title = "$action категорию";
        return $this->render('category', compact('model', 'action'));
    }

    public function actionTagToMaterial() {
        $model = new MaterialTag();
        if ($model->load(Yii::$app->request->post())) {
            if (!MaterialTag::findOne(['material_id' => $model->material_id, 'tag_id' => $model->tag_id]))
                if ($model->save())
                    return $this->redirect(Url::toRoute(['site/material', 'id' => $model->material_id]));
        }
        return $this->redirect(Url::toRoute(['site/material']));
    }

    public function actionLink() {
        $model = new MaterialLink();
        $model->setScenario(MaterialLink::SCENARIO_CREATE);

        $request = Yii::$app->request;

        
        // если get('id') не равен null тогда изменяем ссылку с этим id
        $id = intval($request->get('id'));
        if ($id > 0) {
            if ($model = MaterialLink::findOne($id)) {
                $model->setScenario(MaterialLink::SCENARIO_UPDATE);
            }
            else {
                $model = new MaterialLink();
                $model->setScenario(MaterialLink::SCENARIO_CREATE);
            }
        }
        
        // взаимодействие с БД
        if ($request->isPost) {
            if ($model->load($request->post())) {
                if ($model->save()) return $this->redirect(Url::toRoute(['site/material', 'id' => $model->material_id]));
            }
        }

        if (!MaterialLink::findOne($id))
            return $this->redirect(Url::toRoute(['list/material']));

        $action = $model->getScenario() == MaterialLink::SCENARIO_CREATE ? 'Добавить' : 'Изменить';
        $this->view->title = "$action ссылку";
        return $this->render('link', compact('model', 'action'));
    }
}