<?php

use yii\helpers\Url;
use yii\helpers\Html;

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

            <div id="user-rating" class="dfx-block">
                <h1 class="dfx-title">Создание задания</h1>
                <p class="dfx-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deleniti eum
                    excepturi.</p>
                <div class="indicator"></div>
            </div>

            <div id="main-content" class="dfx-block">

                <div class="create-task-page">
                    <form id="create-task-form" method="post">
                        <input type="text" name="title" class="task-title" placeholder="Заголовок">
                        <input type="text" name="location" class="task-location" placeholder="Район">
                        <input type="text" name="people_count" class="task-people_count" placeholder="Кол-во участников">
                        <input type="text" name="point" class="task-point" placeholder="Кол-во очков (каждому участнику)">
                        <textarea name="text" placeholder="Подробное описание" class="task-text" rows="6"></textarea>

                        <div class="dfx-btn-grp">
                            <a href="" id="create-task" class="dfx-btn dfx-btn-prm-o">Создать</a>
                            <a href="<?= URl::to(['/']) ?>" class="dfx-btn dfx-btn-def-o">Назад</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
