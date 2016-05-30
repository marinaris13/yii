<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Изделия');
?>

<?php
$this->registerJs('            
            $("#new_product").on("pjax:end", function() {
                $("#modal_add").modal("hide");
                $.pjax.reload({container:"#products"});  //Reload GridView
            });   
            '
);
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div style="margin-bottom: 20px;" class="clearfix">

        <?php
        Modal::begin([
            'header'       => '<h2>Добавить изделие!</h2>',
            'id'           => 'modal_add',
            'toggleButton' => [
                'tag'   => 'button',
                'class' => 'btn btn-info pull-right',
                'label' => '+ Добавить изделие',
            ]
        ]);
        ?>
        <?php Pjax::begin(['id' => 'new_product']); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 20]); ?>
        <?= $form->field($model, 'type_material')->textInput(['maxlength' => 20]); ?>
        <?= $form->field($model, 'length')->textInput(['maxlength' => 4]); ?>
        <?= $form->field($model, 'height')->textInput(['maxlength' => 4]); ?>
        <?= $form->field($model, 'width')->textInput(['maxlength' => 4]); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <?php Modal::end(); ?>
    </div>

    <?php Pjax::begin(['id' => 'products']); ?>

    <?=
    GridView::widget([

        'dataProvider' => $dataProvider, // данные
        'summary'      => '', // убираем строку с данными о текущей странице (Showing 1-5 of 10 items)
        'columns'      => [  // задаем колонки
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'type_material',
            'length',
            'height',
            'width',
            [
                'class'          => 'yii\grid\ActionColumn', // кнопки для редактирования
                'contentOptions' => ['style' => 'width:50px;'],
                'template'       => '{update} {delete}',
                'buttons'        => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
                                    'title'   => Yii::t('yii', 'Update'),
                                    'onclick' => 'update_data(' . $model->id . '); return false;',
                        ]);
                    },
                            'delete'         => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'title'        => Yii::t('yii', 'Delete'),
                                    'data-confirm' => 'Вы действительно хотите удалить эту запись?',
                                    'data-method'  => 'post',
                                    'data-pjax'    => '1',
                        ]);
                    },
                        ],
                    ],
                ],
            ]);
            ?>


            <?php Pjax::end(); ?>

            <?php
            Modal::begin([
                'header' => '<h2>Редактировать изделие!</h2>',
                'id'     => 'modal_edit',
            ]);
            ?>
            <div class="form-edit">
            </div>
            <?php Modal::end(); ?>
</div>
<script>
    function update_data(elementId) {
        $.get("/index.php?r=product%2Fget&id=" + elementId, function (data) {
            $(".form-edit").html(data);
            $("#modal_edit").modal("show");
        });
    }
</script>