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
                $.pjax.reload({container: "#manufacturers", timeout: 0});
                e.preventDefault();
                return false;
            });
');
?>

<?php
$form = ActiveForm::begin([
            'options' => ['data-pjax' => 1],
            'action'  => yii\helpers\Url::to(['manufacturer/update', 'id' => $model->id]),
            'id'      => 'form-edit',
        ]);
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 15]); ?>
<?= $form->field($model, 'city')->textInput(['maxlength' => 20]); ?>

<div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
