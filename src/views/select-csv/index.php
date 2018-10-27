<?php

use \kartik\form\ActiveForm;
use \yii\helpers\Html;
?>

<div class="row">
	<div class="col-lg-12">
<h1 style="text-align: center">Добрый день</h1>
		<br>
<h4 style="text-align: center">Выбирите csv файл из каталога или загрузите свой</h4>
		<br>
<h5 style="text-align: center">Список загрженных файлов:</h5>
	</div>
	<div  class="col-lg-12">
 <?php
$form = ActiveForm::begin(['action'=>\yii\helpers\Url::toRoute(['/rusoft/csv-parser',]),'method'=>'get'
	]);
?>
 <?=Html::listBox('fileName','0', $file, [
 		'style'=>[
 				'width'=> '25%',
      'min-height'=>'100px',
			'margin-left'=> '37%',
			'text-align'=>'center'
		]
 ]);?>
  <br>
<?=Html::submitButton('Select', ['class' => 'btn btn-success',
	'style'=>[
    'margin-left'=> '47%'
	]])?>
<?php ActiveForm::end();?>
		<br><br>

<?php
echo Html::a('Добавить новый Сsv файл',\yii\helpers\Url::toRoute(['/rusoft/select-csv/upload']),[
		'style'=>[
				'font-size'=>'26px',
			'text-decoration'=>'underline',
			'margin-left'=>'38%',
			'margin-top'=>'20px'
		]
]);?>
	</div>
</div>
</div>

