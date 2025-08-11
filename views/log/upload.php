<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>Загрузка логов</h1>

<?php if (!empty($message)):?>
    <div class="alert alert-success"><?= Html::encode($message)?></div>
<?php endif;?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]) ?>

<?= $form->field($model, 'logfile')->fileInput()->label('Выберите файл логов') ?>

<button class="btn btn-primary">Загрузить</button>

<?php ActiveForm::end()?>