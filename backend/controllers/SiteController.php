<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\VarDumper;
use app\models\Apples;

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
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'apples'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
        return $this->render('index');
    }

    public function actionApples()
    {
        $applesAr = [];

        if (count($applesFromDb = Apples::find()->asArray()->all()) != 0) {
            foreach ($applesFromDb as $apple) {
                $applesAr[] = new Yii::$app->apple($apple['apple_number'], $apple['color'], $apple['created_at'],
                    $apple['falled_at'], $apple['is_fresh'], $apple['on_the_tree'], $apple['eaten'], 100 - $apple['eaten']); //100 - полное яблоко
            }
        }

        //убрать в отдельный контроллер
        if (Yii::$app->request->post('submit') == 'create_apples') {
            $appleCount = rand(3, 9);
            for ($i = 1; $i <= $appleCount; $i++) {
                $apple = new Yii::$app->apple($i);
                $appleInDb = new Apples();

                $appleInDb->apple_number = $apple->appleNumber;
                $appleInDb->color = $apple->color;
                $appleInDb->eaten = $apple->eaten;
                $appleInDb->is_fresh = $apple->isFresh;
                $appleInDb->on_the_tree = $apple->onTheTree;
                $appleInDb->created_at = strtotime($apple->spawnDate);
                $appleInDb->falled_at = $apple->fallDate;

                $appleInDb->save();

                $applesAr[] = $apple;
            }

            return $this->refresh();
        }

        if (Yii::$app->request->post('submit') == 'remove_apples') {
            Apples::deleteAll();
            $applesAr = [];

            return $this->refresh();
        }

        return $this->render('apples', [
            'apples' => $applesAr
        ]);
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
}
