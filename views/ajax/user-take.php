<?php

/* @var $this yii\web\View */

use yii\helpers\StringHelper;
use yii\helpers\Url;
use app\models\Task;

?>

<h5>Вы откликнулись на:</h5>
<div class="item">
    <?php if (!empty($taken_tasks)): ?>
        <?php foreach ($taken_tasks as $item): ?>
            <p class="name"><i class="fa fa-circle-o" aria-hidden="true"></i><a href="<?= URl::to(['/task/view', 'id' => $item['task_id']]) ?>"><?= Task::findOne($item['task_id'])->title ?></a></p>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="name">К сожалению тут пусто :(</p>
    <?php endif; ?>
</div>


