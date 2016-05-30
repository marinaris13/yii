<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Manufacturer;

class ManufacturerController extends Controller {

    public function actionIndex() {
        $query = Manufacturer::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount'      => $query->count(),
        ]);

        $manufacturers = $query->orderBy('id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index', [
                    'manufacturers'   => $manufacturers,
                    'pagination' => $pagination,
        ]);
    }

}
