<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Manufacturer;

class ManufacturerController extends Controller {

    // действие по умолчанию
    public function actionIndex($id = null) {
        $model = new Manufacturer();

        // если была отправлена форма на добавление и модель успешно сохранена в БД
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new Manufacturer();  // сбрасываем данные модели
        }

        // получаем данные из базы данных
        $dataProvider = new ActiveDataProvider([
            'query' => Manufacturer::find(),
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
        $model = Manufacturer::findOne($id);
        if ($model !== null) {
            $model->delete();
        }
        
        // обновляем данные, вывзвав действие по умолчанию
        $this->actionIndex();
    }

    // получение данныз по ID
    public function actionGet($id) {
        $model = Manufacturer::findOne($id);
        // загружаем форму для модального окна с данными
        return $this->renderAjax('_get', [
                    'model' => $model
        ]);
    }

    // изменение данных
    public function actionUpdate($id) {
        // ищем запись для изменения
        $model = Manufacturer::findOne($id);
        
        // если форма была отправлена и найдена запись для изменения
        if (Yii::$app->request->post('Manufacturer') && $model !== null) {
            $model->setAttributes(Yii::$app->request->post('Manufacturer')); //задаем атрибуты
            $model->update(); // обновляем
        }
        
        // загружаем все данные из БД
        $dataProvider = new ActiveDataProvider([
            'query' => Manufacturer::find(),
        ]);

        // загружаем представление для обновления данных
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

}
