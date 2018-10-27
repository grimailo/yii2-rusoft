<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/10/2018
 * Time: 16:19
 */

namespace grimailo\rusoft\controllers;

use grimailo\rusoft\models\CsvRow;
use grimailo\rusoft\models\SearchCsv;
use ParseCsv;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class CsvParserController extends Controller
{

  public function actionIndex()
  {
    if ($fileName = Yii::$app->request->get('fileName')) {
      Yii::$app->session->set('fileName', $fileName);

      $search = new ParseCsv\Csv();
      $search->encoding('UTF-8','UTF-8');
      $search->auto(Yii::getAlias("@grimailo/rusoft/storage/csv/{$fileName}"));

      $searchModel = new SearchCsv($search);
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $columns = $searchModel->getPropertyName();

      return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'columns' => $columns,'fileName'=>$fileName
      ]);
    }else{
      $this->redirect(Url::to(['/rusoft']));
    }
  }


  public function actionView($id)
  {
    if (!$fileName = Yii::$app->session->get('fileName')) {
      $this->redirect(Url::to(['/rusoft']));
    }

    $search = new ParseCsv\Csv();
    $search->encoding('UTF-8','UTF-8');
    $search->auto(Yii::getAlias("@grimailo/rusoft/storage/csv/{$fileName}"));
    $model = $search->data[$id];

    return $this->render('view', [
      'model' => $model, 'id' => $id,
      'fileName'=>$fileName
    ]);
  }


  public function actionUpdate($id)
  {
    if (!$fileName = Yii::$app->session->get('fileName')) {
      $this->redirect(Url::to(['/rusoft']));
    }

    $search = new ParseCsv\Csv();
    $search->encoding('UTF-8','UTF-8');
    $search->auto(Yii::getAlias("@grimailo/rusoft/storage/csv/{$fileName}"));
    $model = new CsvRow($search->data[$id]);

    return $this->render('update', [
      'model' => $model,
      'fileName'=> $fileName, 'id'=> $id
    ]);
  }


  public function actionWriteData()
  {
    if ((!$fileName = Yii::$app->session->get('fileName')) ||
      (!Yii::$app->request->post())){
      $this->redirect(Url::to(['/rusoft']));
    }

    $model= new CsvRow(Yii::$app->request->post('CsvRow'));
    $id = Yii::$app->request->post('id');

    $search = new ParseCsv\Csv();
    $search->encoding('UTF-8','UTF-8');
    $search->auto(Yii::getAlias("@grimailo/rusoft/storage/csv/{$fileName}"));
    $search->data[$id] = $model->getProperty();
    $search->save();

    $this->redirect(['view', 'id' => $id]);
  }


  public function actionDelete($id)
  {
    if (!$fileName = Yii::$app->session->get('fileName')) {
      $this->redirect(Url::to(['/rusoft']));
    }

    $search = new ParseCsv\Csv();
    $search->encoding('UTF-8','UTF-8');
    $search->auto(Yii::getAlias("@grimailo/rusoft/storage/csv/{$fileName}"));

    //Пришлось изощраться из-за особености библиотеки...
    $data =  array_map(function ($n) {
     return 'null';
    },$search->data[0]);

    unset($search->data[$id]);
    sort($search->data);

    if (count($search->data) == 0){
      $search->data[0] = $data;
    }

    $search->save();

    return $this->redirect(Url::to(['/rusoft/csv-parser?fileName='.$fileName]));
  }

}