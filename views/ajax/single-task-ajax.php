<?php

use yii\helpers\Url;

?>

<div id="user-rating" class="dfx-block">
    <?php if ($rep_diff > 0): ?>
        <h1 class="dfx-title">У человека хорошая репутация</h1>
        <p class="dfx-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deleniti eum
            excepturi.</p>
        <div class="indicator-nice"></div>
    <?php else: ?>
        <h1 class="dfx-title">У человека сомнительная репутация</h1>
        <p class="dfx-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deleniti eum
            excepturi.</p>
        <div class="indicator-bad"></div>
    <?php endif; ?>
</div>

<?php if ($isTaken): ?>
    <div id="user-taken" class="dfx-block">
        <h1 class="dfx-title">Вы уже взяли эту задачу</h1>
        <p class="dfx-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deleniti eum
            excepturi.</p>
        <a href="" id="cancel_task" data-task-id="<?= $model->id ?>" class="dfx-btn dfx-btn-warning-o">Отменить</a>
        <div class="indicator"></div>
    </div>
<?php endif; ?>

<div id="main-content" class="dfx-block">
    <div class="single-task-container single-task-ajax">
        <div class="clearfix">
            <h1 class="dfx-title name"><a href=""><?= $model->title ?></a></h1>
            <div class="lables clearfix"><span class="points"><?= $model->point ?> баллов</span><span class="peoples"><?= $model->take_count ?>/<?= $model->people_count ?> чел.</span></div>
        </div>
        <div class="info">
            <span><i class="fa fa-user-o"></i><a href=""><?= \app\models\User::getFullName($model->user_id) ?></a></span>
            <span><i class="fa fa-calendar-check-o"></i><?= date("d-m-Y", $model->date) ?></span>
            <span><i class="fa fa-map-marker"></i><?= $model->location ?></span>
        </div>
        <div class="img-container">
            <img src="img/banner-2.png" class="dfx-img-rsp"/>
        </div>
        <div class="content">
            <p><?= $model->text ?></p>
            <div class="dfx-btn-grp">
                <?php if (!$isTaken): ?>
                    <a href="" id="take_task" class="dfx-btn dfx-btn-prm-o" data-task-id="<?= $model->id ?>">Откликнтуься</a>
                <?php endif; ?>
                <a href="<?= URl::to(['/']) ?>" class="dfx-btn dfx-btn-def-o">Назад</a>
            </div>
        </div>
    </div>

</div>
