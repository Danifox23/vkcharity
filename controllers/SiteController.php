<?php

namespace app\controllers;

use app\models\Feedback;
use app\models\User;
use app\models\Task;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use VK\VK;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $vk = new VK('6210775', 'rMG8O7Gro6QTSQo0WUx3');

        $session = Yii::$app->session;
        $session->open();

        if ($session->has('user_id'))
        {
            $user_id = $session->get('user_id');
        }
        else
        {
            $user_id = Yii::$app->request->get('viewer_id');
            $session->set('user_id', $user_id);
        }

        $isLogin = User::findByVk($user_id);
        if ($isLogin) {
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
        } else {
            $user = new User();
            $user->id = $user_id;
            $user->rep = 0;
            $user->point = 0;
            $user->completed = 0;
            $user->canceled = 0;
            $user->save();

            $stats = [
                'rep' => $user->rep,
                'point' => $user->point,
                'completed' => $user->completed,
                'canceled' => $user->canceled,
                'status' => 'Новичёк'
            ];

            $query = $vk->api('users.get', ['user_ids' => $user_id, 'fields' => 'photo_100,city']);

            $fullname = $query['response'][0]['first_name'] . ' ' . $query['response'][0]['last_name'];
            $city = $vk->api('database.getCitiesById', ['city_ids' => $query['response'][0]['city']]);
            $city_name = $city['response'][0]['name'];
            $avatar = $query['response'][0]['photo_100'];
        }

        // Значения статусов
        // 1 - В процессе
        // 2 - Набор окончен
        // 3 - Завершена
        // 3 - Отменена

        $tasks = Task::find()->all();

        $taken_tasks = Feedback::find()->where(['user_id' => $user_id])->asArray()->all();


        return $this->render('index', [
            'fullname' => $fullname,
            'city_name' => $city_name,
            'avatar' => $avatar,
            'stats' => $stats,
            'tasks' => $tasks,
            'taken_tasks' => $taken_tasks
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
