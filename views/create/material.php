<?php

use app\models\Categories;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1 class="my-md-5 my-4"><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-lg-5 col-md-8">

        <?php
        $form = ActiveForm::begin([
            'id' => 'material-link-form',
            'fieldConfig' => [
                'template' => "{input}\n{label}\n{hint}\n{error}",
                'options' => [
                    'class' => 'form-floating mb-3',
                ],
                'errorOptions' => [
                    'class' => 'help-block text-danger',
                    'style' => [
                        'font-size' => '.875em',
                    ]
                ],
            ],
        ]);

        echo $form->field($model, 'id', [
            'options' => [
                'style' => [
                    'display' => 'none'
                ]
            ]
        ])->textInput(['type' => 'number', 'value' => $model->id]);

        echo $form->field($model, 'type')->dropDownList(
            [
                null => 'Выберите тип',
                1 => 'Книга',
                2 => 'Статья',
                3 => 'Видео',
                4 => 'Сайт/Блог',
                5 => 'Подборка',
                6 => 'Ключевые идеи книги',
            ],
            [
                'class' => 'form-select',
                'options' => [
                    null => [
                        'disabled' => true,
                        'selected' => true,
                    ],
                ],
            ],
        );

        $lst[null] = 'Выберите категорию';
        $lst += ArrayHelper::map(Categories::find()->all(), 'id', 'name');

        echo $form->field($model, 'category')->dropDownList(
            $lst,
            [
                'class' => 'form-select',
                'options' => [
                    null => [
                        'disabled' => true,
                        'selected' => true,
                    ],
                ],
            ],
        );
        echo $form->field($model, 'name')->textInput(['maxlength' => 63, 'placeholder' => ' ']);
        echo $form->field($model, 'author')->textInput(['maxlength' => 65535, 'placeholder' => ' ']);
        echo $form->field($model, 'description')->textarea(['maxlength' => 65535, 'placeholder' => ' ', 'style' => ['height' => '100px']]);

        echo Html::submitButton($action, ['class' => 'btn btn-primary']);

        ActiveForm::end();
        ?>
        
    </div>
</div>