<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/10/2018
 * Time: 22:05
 */

namespace grimailo\rusoft\models;


use ParseCsv\Csv;
use yii\base\Model;

class CsvRow extends Model
{

  protected $propertyArr = [];


  public function rules()
  {
    return [
      [$this->getPropertyName(),'safe']
    ];
  }


  public function getPropertyName()
  {
    return array_keys($this->propertyArr);
  }

  public function __get($name)
  {
    if (isset($this->propertyArr[$name]) || array_key_exists($name, $this->propertyArr)) {
      return $this->propertyArr[$name];
    }
  }

  public function __set($name, $value)
  {
    $this->propertyArr[$name] = $value;
  }

  public function getProperty()
  {
    return $this->propertyArr;
  }

}