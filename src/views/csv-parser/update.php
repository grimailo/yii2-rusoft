<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $model grimailo\rusoft\models\CsvRow */

$this->params['breadcrumbs'][] = ['label' => 'Выбрать другой файл', 'url' => \yii\helpers\Url::to(['/rusoft'])];
$this->params['breadcrumbs'][] = ['label' => $fileName, 'url' => Url::to(['/rusoft/csv-parser?fileName='.$fileName])];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-update">


    <?= $this->render('_form', [
        'model' => $model, 'id'=> $id
    ]) ?>

</div>
