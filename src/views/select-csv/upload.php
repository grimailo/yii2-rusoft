<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/10/2018
 * Time: 23:08
 */

use \kartik\form\ActiveForm;
use \yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var grimailo\rusoft\models\UploadForm $upload
 */

$this->params['breadcrumbs'][] = ['label' => 'Выбор файла', 'url' => Url::to(['/rusoft'])];
$this->params['breadcrumbs'][] = 'UploadFile';
?>
<div class="row">
	<div class="col-lg-12">
<h2 style="text-align: center">Загрузить файл</h2>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',
  'style'=>[
    'width'=> '25%',
    'min-height'=>'100px',
    'margin-left'=> '37%',
    'text-align'=>'center'
  ]
	],
  'action'=> Url::to(['/rusoft/select-csv/upload'])]) ?>

<?= $form->field($upload, 'csv',['options'=>['style'=>['margin-left'=>'50px']]])->fileInput() ?>

<?=Html::submitButton('Load', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end();?>
	</div>
</div>
