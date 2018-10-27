<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel grimailo\rusoft\models\SearchCsv */
/* @var $dataProvider yii\data\ArrayDataProvider*/

$this->title = $fileName;

$this->params['breadcrumbs'][] = ['label' => 'Выбрать другой файл',
	'url' => Url::to(['/rusoft'])];
$this->params['breadcrumbs'][] = 'Данные';
?>
<div class="city-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' =>
			array_merge([['class' => 'yii\grid\SerialColumn']],
				$columns,
      [['class' => 'yii\grid\ActionColumn']]
		)
  ]); ?>
</div>