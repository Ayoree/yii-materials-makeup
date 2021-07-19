<?php

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
            ]
        ]);
        
        echo $form->field($model, 'material_id')->hiddenInput();
        echo $form->field($model, 'link_title')->textInput(['maxlength' => 63, 'placeholder' => ' ']);
        echo $form->field($model, 'link_url')->textInput(['maxlength' => 127, 'placeholder' => ' ']);
        
        echo Html::submitButton($action, ['class' => 'btn btn-primary']);
        
        ActiveForm::end();
        ?>

    </div>
</div>