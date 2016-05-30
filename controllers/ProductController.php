<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use yii\data\ActiveDataProvider;

class ProductController extends Controller {

    public function actionIndex($id = null) {
        $product = new Product();

        // если была отправлена форма на добавление, то сохраняем объект в БД
        if ($product->load(Yii::$app->request->post()) && $product->save()) {
            $product = new Product();
        }

        if ($id !== null) {
            $product = Product::findOne($id);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $product,
        ]);
    }

    public function actionDelete($id) {
        $product = Product::findOne($id);
        $product->delete();

        $this->actionIndex();
    }

    public function actionGet($id) {
        $model = Product::findOne($id);
        return $this->renderAjax('_get', [
                    'model' => $model
        ]);
    }

    public function actionUpdate($id) {

        $product = Product::findOne($id);


        if (Yii::$app->request->post('Product')) {
            $product->setAttributes(Yii::$app->request->post('Product'));
            $product->update();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $product,
        ]);
    }

}
