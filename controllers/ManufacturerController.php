<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Manufacturer;

class ManufacturerController extends Controller {

   public function actionIndex($id = null) {
        $model = new Manufacturer();

        // если была отправлена форма на добавление, то сохраняем объект в БД
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new Manufacturer();
        }

        if ($id !== null) {
            $model = Manufacturer::findOne($id);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Manufacturer::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $model,
        ]);
    }

    public function actionDelete($id) {
        $model = Manufacturer::findOne($id);
        $model->delete();

        $this->actionIndex();
    }

    public function actionGet($id) {
        $model = Manufacturer::findOne($id);
        return $this->renderAjax('_get', [
                    'model' => $model
        ]);
    }

    public function actionUpdate($id) {

        $model = Manufacturer::findOne($id);


        if (Yii::$app->request->post('Manufacturer')) {
            $model->setAttributes(Yii::$app->request->post('Manufacturer'));
            $model->update();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Manufacturer::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $model,
        ]);
    }

}
