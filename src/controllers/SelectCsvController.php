<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/10/2018
 * Time: 00:14
 */

namespace grimailo\rusoft\controllers;


use grimailo\rusoft\models\UploadForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class SelectCsvController extends Controller
{

  public function actionIndex()
  {
    $files= FileHelper::findFiles(\Yii::getAlias('@grimailo/rusoft/storage/csv'),['only'=>['*.csv']]);
    $files =  array_map(function($n){
      return basename($n);
      },$files);
    $files = array_combine($files,$files);

    return $this->render('index',['file'=>$files]);
  }

  public function actionUpload()
  {
    $upload = new UploadForm();

    if (\Yii::$app->request->post()) {
      $upload->csv = UploadedFile::getInstance($upload, 'csv');
      if ($upload->upload()){
        $this->redirect(Url::to(['/rusoft']));
      }
    }

    return $this->render('upload',['upload'=>$upload]);
  }
}