<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerJs(' 
            $("#form-edit").on("submit", function(e) {
                var url = $(this).attr("action");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#form-edit").serialize()
                  });
                $("#modal_edit").modal("hide");
                $.pjax.reload({container:"#products", timeout: 0});
                e.preventDefault();
                return false;
            });
');
?>

<?php
$form = ActiveForm::begin([
            'options' => ['data-pjax' => 1],
            'action'  => yii\helpers\Url::to(['product/update', 'id' => $model->id]),
            'id'      => 'form-edit',
        ]);
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 20]); ?>
<?= $form->field($model, 'type_material')->textInput(['maxlength' => 20]); ?>
<?= $form->field($model, 'length')->textInput(['maxlength' => 4]); ?>
<?= $form->field($model, 'height')->textInput(['maxlength' => 4]); ?>
<?= $form->field($model, 'width')->textInput(['maxlength' => 4]); ?>

<div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
