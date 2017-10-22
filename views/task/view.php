<?php

/* @var $this yii\web\View */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="container-fluid">
    <div class="row dfx-block-wrapper">
        <div class="col-md-4 dfx-block">
            <div id="sidebar" class="dfx-block ajax-sidebar">
                <div class="user-profile clearfix">
                    <div class="img-container">
                        <img src="<?= $avatar ?>" class="dfx-img-rsp">
                    </div>
                    <div class="user-info">
                        <h5 class="name"><?= $fullname ?></h5>
                        <h5 class="town">г.<?= $city_name ?></h5>
                    </div>
                </div>

                <div class="user-stats">
                    <p><i class="fa fa-heart-o" aria-hidden="true"></i>Репутация: <span class="rep"><?= $stats['status']. ' ' ?> </span><span class="stat">(<span class="plus"><?= $stats['completed'] ?></span>/<span class="minus">-<?= $stats['canceled'] ?></span>)</span></p>
                    <p><i class="fa fa-star-o" aria-hidden="true"></i>Ваши баллы: <span class="rep"><?= $stats['point'] ?></span></p>
                </div>

                <div class="user-take">
                    <?= $this->render('../ajax/user-take', [
                        'taken_tasks' => $taken_tasks,
                    ]) ?>
                </div>

                <div class="user-give">
                    <h5>Вы попросили:</h5>
                    <div class="item">
                        <p class="name"><i class="fa fa-dot-circle-o" aria-hidden="true"></i><a href="">Помогите плез перенести...</a></p>
                        <p class="name"><i class="fa fa-dot-circle-o" aria-hidden="true"></i><a href="">Помогите плез какой-то другой...</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 dfx-block single-task-ajax">
            <?= $this->render('../ajax/single-task-ajax', [
                'model' => $model,
                'isTaken' => $isTaken,
                'rep_diff' => $rep_diff
            ]) ?>
        </div>
    </div>
</div>