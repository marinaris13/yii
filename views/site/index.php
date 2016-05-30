<?php

/* @var $this yii\web\View */

$this->title = 'Склад ООО "Беликова"';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать на склад</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Изделия</h2>

                <p>Список изделий с размерами и наименованием материала, из которого они изготовлены</p>

                <p><a class="btn btn-default" href="<?= yii\helpers\Url::to(['product/index']) ?>">Подробнее &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Изготовители</h2>

                <p>Список изготовителей с названием города, в котором расположены эти изготовители</p>

                <p><a class="btn btn-default" href="<?= yii\helpers\Url::to(['manufacturer/index']) ?>">Подробнее &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Стелажи</h2>

                <p>Список стелажей с описанием местоположения, где находятся эти стелажи</p>

                <p><a class="btn btn-default" href="<?= yii\helpers\Url::to(['shelving/index']) ?>">Подробнее &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
