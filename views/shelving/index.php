<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Стелажи');
?>

<?php
$this->registerJs('            
            $("#new_shelving").on("pjax:end", function() {
                $("#modal_add").modal("hide");
                $.pjax.reload({container:" #shelvings", timeout: 0});  //Reload GridView                
            });   
            '
);
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div style="margin-bottom: 20px;" class="clearfix">

        <?php
        Modal::begin([
            'header'       => '<h2>Добавить стелаж!</h2>',
            'id'           => 'modal_add',
            'toggleButton' => [
                'tag'   => 'button',
                'class' => 'btn btn-info pull-right',
                'label' => '+ Добавить стелаж',
            ]
        ]);
        ?>
        <?php Pjax::begin(['id' => 'new_shelving']); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 8]); ?>
        <?= $form->field($model, 'whereabouts')->textInput(['maxlength' => 40]); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <?php Modal::end(); ?>
    </div>

    <?php Pjax::begin(['id' => 'shelvings']); ?>

    <?=
    GridView::widget([

        'dataProvider' => $dataProvider, // данные
        'summary'      => '', // убираем строку с данными о текущей странице (Showing 1-5 of 10 items)
        'columns'      => [  // задаем колонки
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'whereabouts',
            [
                'class'          => 'yii\grid\ActionColumn', // кнопки для редактирования
                'contentOptions' => ['style' => 'width:50px;'],
                'template'       => '{update} {delete}',
                'buttons'        => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
                                    'title'   => Yii::t('yii', 'Изменить'),
                                    'onclick' => 'update_data(' . $model->id . '); return false;',
                        ]);
                    },
                            'delete'         => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'title'        => Yii::t('yii', 'Удалить'),
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
                'header' => '<h2>Редактировать стелаж!</h2>',
                'id'     => 'modal_edit',
            ]);
            ?>
            <div class="form-edit">
            </div>
            <?php Modal::end(); ?>
</div>
<script>
    function update_data(elementId) {
        $.get("/index.php?r=shelving%2Fget&id=" + elementId, function (data) {
            $(".form-edit").html(data);
            $("#modal_edit").modal("show");
        });
    }
</script>