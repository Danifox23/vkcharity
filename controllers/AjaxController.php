<?php

namespace app\controllers;

use app\models\Task;
use app\models\User;
use app\models\Feedback;
use Faker\Provider\DateTime;
use VK\VK;
use Yii;

class AjaxController extends \yii\web\Controller
{

    public function actionTakeTask()
    {
        if (Yii::$app->request->post('task_id')) {

            $task_id = Yii::$app->request->post('task_id');

            $session = Yii::$app->session;
            $session->open();

            $feedback = new Feedback();
            $feedback->user_id = $session->get('user_id');
            $feedback->task_id = $task_id;
            $feedback->save();

            $task = Task::findOne($task_id);
            $task->take_count += 1;
            $task->save();

            $taken_tasks = Feedback::find()->where(['user_id' => Yii::$app->session->get('user_id')])->asArray()->all();

            $this->layout = false;

            return $this->render('user-take', [
                'taken_tasks' => $taken_tasks,
            ]);
        }
        return false;
    }

    public function actionCancelTask()
    {
        if (Yii::$app->request->post('task_id')) {

            $task_id = Yii::$app->request->post('task_id');

            $session = Yii::$app->session;
            $session->open();

            $user_id = $session->get('user_id');

            $task = Task::findOne($task_id);

            $isTaken = false;
            $feedback = Feedback::find()->where(['user_id' => $user_id])->andWhere(['task_id' => $task_id])->one();
            $feedback->delete();

            $task = Task::findOne($task_id);
            $task->take_count -= 1;
            $task->save();

            $user = User::findOne($user_id);
            $user->canceled += 1;
            $user->save();

            $this->layout = false;

            return $this->render('single-task-ajax', [
                'model' => $task,
                'isTaken' => $isTaken
            ]);
        }
        return false;
    }

    public function actionCreateTask()
    {

        if (Yii::$app->request->post()) {

            $session = Yii::$app->session;
            $session->open();

            $user_id = $session->get('user_id');

            $task = new Task();
            $task->title = Yii::$app->request->post('task-title');
            $task->location = Yii::$app->request->post('task-title');
            $task->text = Yii::$app->request->post('task-title');
            $task->people_count = Yii::$app->request->post('task-title');
            $task->point = Yii::$app->request->post('task-title');
//            $task->date = new \DateTime();
            $task->user_id = $user_id;
            $task->take_count = 0;
            $task->save();

            return true;
        }
        return false;
    }

}
