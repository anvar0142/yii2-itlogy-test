<?php

namespace backend\controllers;

use backend\models\Lesson;
use common\models\LoginForm;
use \yii\base\Exception;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'lesson', 'complete-lesson'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
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
        $lessons = Lesson::find()->asArray()->all();
        $completed = true;
        $uncompletedLessons = array_filter($lessons, function ($lesson) {
            return $lesson['status'] == 0;
        });
        $completed = count($uncompletedLessons) === 0;
        return $this->render('index', ['lessons' => $lessons, 'completed' => $completed]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

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

    public function actionLesson() {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            return $this->goBack();
        }
        $lesson = Lesson::find()->where(['id' => $id])->asArray()->one();
        return $this->render('lesson', ['lesson' => $lesson]);
    }

    public function actionCompleteLesson() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->getBodyParam('id');
            $lesson = Lesson::findOne(['id' => $id]);
            $lesson->status = 1;
            if ($lesson->save()) {
                return json_encode(['message' => 'ok']);
            } else {
                throw new Exception('Error on update');
            }
        }
    }
}
