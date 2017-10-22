<?php

namespace app\controllers;

use app\models\Feedback;
use app\models\Task;
use app\models\User;
use VK\VK;
use Yii;

class TaskController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Task();

        $vk = new VK('6210775', 'rMG8O7Gro6QTSQo0WUx3');
        $user_id = Yii::$app->session->get('user_id');

        $user = User::find()->where(['id' => $user_id])->one();

        $rep_diff = $user->completed - $user->canceled;

        $query = $vk->api('users.get', ['user_ids' => $user_id, 'fields' => 'photo_100,city']);

        $fullname = $query['response'][0]['first_name'] . ' ' . $query['response'][0]['last_name'];
        $city = $vk->api('database.getCitiesById', ['city_ids' => $query['response'][0]['city']]);
        $city_name = $city['response'][0]['name'];
        $avatar = $query['response'][0]['photo_100'];

        $stats = [
            'rep' => $user->rep,
            'point' => $user->point,
            'completed' => $user->completed,
            'canceled' => $user->canceled,
            'status' => ''
        ];

        if ($rep_diff < 0) {
            $stats['status'] = 'Безответственный';
        } elseif ($rep_diff == 0) {
            $stats['status'] = 'Новичок';
        } elseif ($rep_diff > 0 && $rep_diff <= 5) {
            $stats['status'] = 'Проверенный';
        } elseif ($rep_diff > 5 && $rep_diff <= 15) {
            $stats['status'] = 'Ответственный';
        } elseif ($rep_diff > 15) {
            $stats['status'] = 'Надежный';
        }

        $taken_tasks = Feedback::find()->where(['user_id' => $user_id])->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = time();
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'fullname' => $fullname,
                'city_name' => $city_name,
                'avatar' => $avatar,
                'stats' => $stats,
                'taken_tasks' => $taken_tasks,
            ]);
        }
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);
        $vk = new VK('6210775', 'rMG8O7Gro6QTSQo0WUx3');
        $user_id = Yii::$app->session->get('user_id');

        $user = User::find()->where(['id' => $user_id])->one();

        $rep_diff = $user->completed - $user->canceled;

        $query = $vk->api('users.get', ['user_ids' => $user_id, 'fields' => 'photo_100,city']);

        $fullname = $query['response'][0]['first_name'] . ' ' . $query['response'][0]['last_name'];
        $city = $vk->api('database.getCitiesById', ['city_ids' => $query['response'][0]['city']]);
        $city_name = $city['response'][0]['name'];
        $avatar = $query['response'][0]['photo_100'];

        $stats = [
            'rep' => $user->rep,
            'point' => $user->point,
            'completed' => $user->completed,
            'canceled' => $user->canceled,
            'status' => ''
        ];

        if ($rep_diff < 0) {
            $stats['status'] = 'Безответственный';
        } elseif ($rep_diff == 0) {
            $stats['status'] = 'Новичок';
        } elseif ($rep_diff > 0 && $rep_diff <= 5) {
            $stats['status'] = 'Проверенный';
        } elseif ($rep_diff > 5 && $rep_diff <= 15) {
            $stats['status'] = 'Ответственный';
        } elseif ($rep_diff > 15) {
            $stats['status'] = 'Надежный';
        }

        $isTaken = Feedback::find()->where(['user_id' => $user_id])->andWhere(['task_id' => $id])->one();

        if ($isTaken !== null)
        {
            $isTaken = true;
        }
        else
        {
            $isTaken = false;
        }

        $taken_tasks = Feedback::find()->where(['user_id' => $user_id])->asArray()->all();

        return $this->render('view', [
            'model' => $task,
            'fullname' => $fullname,
            'city_name' => $city_name,
            'avatar' => $avatar,
            'stats' => $stats,
            'isTaken' => $isTaken,
            'taken_tasks' => $taken_tasks,
            'rep_diff' => $rep_diff
        ]);
    }

}
