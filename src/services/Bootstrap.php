<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/10/2018
 * Time: 22:11
 */
namespace grimailo\rusoft\services;

use \yii\base\BootstrapInterface;
class Bootstrap implements BootstrapInterface
{

  public function bootstrap($app)
  {
    $app->getUrlManager()->addRules([
      'rusoft' => 'rusoft/select-csv/index',
    ], false);

    $app->setModule('rusoft', ['class'=>'grimailo\rusoft\Module']);
    $app->setModule('gridview', ['class' => 'kartik\grid\Module']);
  }

}