<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Shelving;

class ShelvingController extends Controller {

    // действие по умолчанию
    public function actionIndex($id = null) {
        $model = new Shelving();

        // если была отправлена форма на добавление, то сохраняем объект в БД
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new Shelving(); // сбрасываем данные после сохранения
        }

        // получаем данные из базы данных
        $dataProvider = new ActiveDataProvider([
            'query' => Shelving::find(),
        ]);

        // загружаем представление для вывода
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    // удаление
    public function actionDelete($id) {
        // ищем запись в БД по ID. если находим, то удаляем
        $model = Shelving::findOne($id);
        $model->delete();

        // обновляем данные, вывзвав действие по умолчанию
        $this->actionIndex();
    }

    // получение данныз по ID
    public function actionGet($id) {
        $model = Shelving::findOne($id);
        // загружаем форму для модального окна с данными
        return $this->renderAjax('_get', [
                    'model' => $model
        ]);
    }
    
    // изменение данных
    public function actionUpdate($id) {
        // ищем запись для изменения
        $model = Shelving::findOne($id);

        // если форма была отправлена и найдена запись для изменения
        if (Yii::$app->request->post('Shelving')) {
            $model->setAttributes(Yii::$app->request->post('Shelving'));
            $model->update();
        }

        // загружаем все данные из БД
        $dataProvider = new ActiveDataProvider([
            'query' => Shelving::find(),
        ]);

        // загружаем представление для обновления данных
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

}
