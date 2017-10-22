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

        <div class="col-md-8 dfx-block">
            <div id="page-desc" class="dfx-block">
                <h1 class="dfx-title">Активные задачи</h1>
                <p class="dfx-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deleniti eum excepturi laudantium maiores molestiae natus provident quae quam tempora?</p>
            </div>
            <div id="main-content" class="dfx-block">
                <div class="task-container">
                    <?php if (!empty($tasks)): ?>
                        <?php foreach ($tasks as $item): ?>
                            <div class="task">
                                <div class="clearfix">
                                    <h3 class="name"><a href="<?= URl::to(['/task/view', 'id' => $item->id]) ?>"><?= $item->title ?></a></h3>
                                    <div class="lables clearfix"><span class="points"><?= $item->point ?> баллов</span><span class="peoples"><?= $item->take_count ?>/<?= $item->people_count ?> чел.</span></div>
                                </div>
                                <div class="info">
                                    <span><i class="fa fa-user-o"></i><a href=""><?= \app\models\User::getFullName($item->user_id) ?></a></span>
                                    <span><i class="fa fa-calendar-check-o"></i><?= date("d-m-Y", $item->date) ?></span>
                                    <span><i class="fa fa-map-marker"></i><?= $item->location ?></span>
                                </div>
                                <p class="desc"><?= StringHelper::truncate($item->text, 200, '...') ?></p>
                                <div class="dfx-btn-grp">
                                    <a href="" id="take_task" data-task-id="<?= $item->id ?>" class="dfx-btn dfx-btn-prm-o">Откликнуться</a>
                                    <a href="<?= URl::to(['/task/view', 'id' => $item->id]) ?>" class="dfx-btn dfx-btn-def-o">Подробнее</a>
                                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h5 class="dfx-title dfx-title-warning">К сожалению записей пока нет.</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
