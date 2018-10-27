<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/10/2018
 * Time: 08:41
 */

namespace grimailo\rusoft\models;


use ParseCsv\Csv;
use yii\data\ArrayDataProvider;

class SearchCsv extends CsvRow
{
  public $data;

  public function __construct(Csv $csv)
  {
    $this->data = $csv->data;
    $this->setPropertyArr($csv->titles);
  }


  public function search($params = null)
  {

    $class = (new \ReflectionClass($this))->getShortName();
    $data = $this->data;

    if (!empty($params[$class])) {
      $validateParams = $this->checkParams($params[$class]);
      if (!empty($validateParams)) {
        $tmpData = $this->searchValue($validateParams);
        if (!empty($tmpData)){
          $data = $tmpData;
        }
      }
    }

    $dataProvider = new ArrayDataProvider([
      'allModels' => $data,
      'pagination'=> [
        'pageSize'=>5
      ],
      'sort' => [
        'attributes' => $this->getPropertyName(),
      ],
    ]);

    return $dataProvider;
  }


  public function checkParams($params)
  {
    foreach ($params as $key => $val) {
      if (empty($params[$key])) {
        unset($params[$key]);
      }
    }
    return $params;
  }
  public function searchValue($searchValue)
  {
    $keys = array_keys($searchValue);
    $newData = [];

    for ($i = 0; $i< count($this->data); $i++) {
      foreach ($this->data[$i] as $key => $data) {
        if (in_array($key, $keys)) {
          $pattern = trim($searchValue[$key]);
          $this->propertyArr[$key] = $pattern;
          if (preg_match("#\w?$pattern\w?#ui", $data)) {
            $newData[] = $this->data[$i];
            break;
          }
        }
      }
    }
    return $newData;
  }

  public function setPropertyArr($property)
  {
    foreach ($property as $value) {
      $this->propertyArr[$value] = null;
    }
  }


}