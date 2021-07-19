<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="main-wrapper">
        <div class="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <?= Html::a('Test', '/web', ['class' => 'navbar-brand']); ?>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <?php
                            $action_id = yii::$app->controller->action->getUniqueId();
                            ?>
                            <li class="nav-item">
                                <?= Html::a(
                                    'Материалы',
                                    '/web/index.php?r=list/material',
                                    [
                                        'class' => 'nav-link'
                                            . (strcmp($action_id, 'list/material') == 0 ? ' active' : '')
                                    ]
                                ); ?>
                            </li>
                            <li class="nav-item">
                                <?= Html::a(
                                    'Теги',
                                    '/web/index.php?r=list/tag',
                                    [
                                        'class' => 'nav-link'
                                            . (strcmp($action_id, 'list/tag') == 0 ? ' active' : '')
                                    ]
                                ); ?>
                            </li>
                            <li class="nav-item">
                                <?= Html::a(
                                    'Категории',
                                    '/web/index.php?r=list/category',
                                    [
                                        'class' => 'nav-link'
                                            . (strcmp($action_id, 'list/category') == 0 ? ' active' : '')
                                    ]
                                ); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container">
                <?= $content ?>
            </div>
        </div>

        <footer class="footer py-4 mt-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col text-muted">Test</div>
                </div>
            </div>
        </footer>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>