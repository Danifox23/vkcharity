<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="base-wrapper">
    <div class="container-fluid">
        <div class="row dfx-block-wrapper">
            <div class="col-md-12">
                <section id="top-menu" class="dfx-block">
                    <ul class="menu">
                        <li><a href="">Задания</a></li>
                        <li><a href="">Топ пользователей</a></li>
                        <li><a href="">Личный кабинет</a></li>
                    </ul>
                    <div class="top-actions">
                        <a href="<?= URl::to(['/task/create']) ?>" class="create-task">Создать задание</a>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?= $content ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>