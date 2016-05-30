<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use yii\data\ActiveDataProvider;

class ProductController extends Controller {

    // действие по умолчанию
    public function actionIndex($id = null) {
        $product = new Product();

        // если была отправлена форма на добавление, то сохраняем объект в БД
        if ($product->load(Yii::$app->request->post()) && $product->save()) {
            $product = new Product(); // сбрасываем данные после сохранения
        }
        
        // получаем данные из базы данных
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        // загружаем представление для вывода
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $product,
        ]);
    }

    // удаление
    public function actionDelete($id) {
        // ищем запись в БД по ID. если находим, то удаляем
        $product = Product::findOne($id);
        if ($product !== null) {
            $product->delete();
        }
        
        // обновляем данные, вывзвав действие по умолчанию
        $this->actionIndex();
    }

    // получение данныз по ID
    public function actionGet($id) {
        $model = Product::findOne($id);
        // загружаем форму для модального окна с данными
        return $this->renderAjax('_get', [
                    'model' => $model
        ]);
    }

    // изменение данных
    public function actionUpdate($id) {
        // ищем запись для изменения
        $product = Product::findOne($id);

        // если форма была отправлена и найдена запись для изменения
        if (Yii::$app->request->post('Product')) {
            $product->setAttributes(Yii::$app->request->post('Product'));
            $product->update();
        }
        
        // загружаем все данные из БД
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        // загружаем представление для обновления данных
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $product,
        ]);
    }

}
