<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Shelving;

class ShelvingController extends Controller {

    public function actionIndex($id = null) {
        $model = new Shelving();

        // если была отправлена форма на добавление, то сохраняем объект в БД
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new Shelving();
        }

        if ($id !== null) {
            $model = Shelving::findOne($id);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Shelving::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $model = Shelving::findOne($id);
        $model->delete();

        $this->actionIndex();
    }

    public function actionGet($id) {
        $model = Shelving::findOne($id);
        return $this->renderAjax('_get', [
                    'model' => $model
        ]);
    }

    public function actionUpdate($id) {

        $model = Shelving::findOne($id);


        if (Yii::$app->request->post('Shelving')) {
            $model->setAttributes(Yii::$app->request->post('Shelving'));
            $model->update();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Shelving::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

}
