<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use \yii\helpers\Url;

/* @var $model grimailo\rusoft\models\CsvRow */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(['action'=>Url::to(['/rusoft/csv-parser/write-data']),
			'method'=>'post']); ?>

	<?php foreach ($model->getProperty() as $key =>  $value) {?>
    <?= $form->field($model, $key)->textInput() ?>
	<?}?>
  <?= Html::hiddenInput('id',$id)?>

	<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
