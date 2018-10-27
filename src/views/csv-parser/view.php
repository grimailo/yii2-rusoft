<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Выбрать другой файл', 'url' => \yii\helpers\Url::to(['/rusoft'])];
$this->params['breadcrumbs'][] = ['label' => $fileName, 'url' => Url::to(['/rusoft/csv-parser?fileName='.$fileName])];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="city-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => array_keys($model)
    ]) ?>

</div>
