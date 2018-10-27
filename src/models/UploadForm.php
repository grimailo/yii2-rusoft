<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/10/2018
 * Time: 00:54
 */

namespace grimailo\rusoft\models;


use yii\base\Model;

class UploadForm extends Model
{

  public $csv;

  public function rules()
  {
    return [
      [['csv'], 'file', 'skipOnEmpty' => false, 'extensions'=>['csv'], 'checkExtensionByMimeType'=>false],
    ];
  }

  public function attributeLabels()
  {
   return [
     'csv'=>'формат .csv'
   ];
  }

  public function upload()
  {
    if ($this->validate()) {
      $this->csv->saveAs(\Yii::getAlias('@grimailo/rusoft/storage/csv/') . $this->csv->baseName . '.' . $this->csv->extension);
      return true;
    } else {
      return false;
    }
  }
}