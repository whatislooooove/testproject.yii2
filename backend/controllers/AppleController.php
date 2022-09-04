<?php

namespace backend\controllers;

use app\models\Apples;
use Yii;
use yii\web\Controller;

class AppleController extends Controller
{
    public function actionDrop() {
        if (Yii::$app->request->post('apple_number') &&
            Yii::$app->request->post('date')) {
            $appleNum = Yii::$app->request->post('apple_number');

            $appleData = Apples::find()->where(['apple_number' => $appleNum])->asArray()->one();
            $apple = new Yii::$app->apple($appleNum, $appleData['color'], $appleData['created_at'],
                $appleData['falled_at'], $appleData['is_fresh'], $appleData['on_the_tree'], $appleData['eaten'],
                100 - $appleData['eaten']);
            $apple->fallToGround();

            echo json_encode(['result' => 'good']);
        }
    }

    public function actionEat() {
        if (Yii::$app->request->post('apple_number') &&
            Yii::$app->request->post('percent')) {
            $appleNum = Yii::$app->request->post('apple_number');
            $percentEat = Yii::$app->request->post('percent');

            $appleData = Apples::find()->where(['apple_number' => $appleNum])->asArray()->one();
            $apple = new Yii::$app->apple($appleNum, $appleData['color'], $appleData['created_at'],
                $appleData['falled_at'], $appleData['is_fresh'], $appleData['on_the_tree'], $appleData['eaten'],
                100 - $appleData['eaten']);
            $apple->eat($percentEat);

            echo json_encode(['result' => 'good']);
        }
    }
}