<?php

namespace Drupal\simple\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomSimpleController extends ControllerBase {

  public function __construct()
  {
  }

  public function customfunction()
  {
    $Allsimple = \Drupal::entityTypeManager()->getStorage('simple')->loadMultipleByType('simple_type_2');
    var_dump($Allsimple);

    die();


    $mymarkuparray = array(
      '#title' => 'Hello from simple module !',
      '#markup' => 'Here is some content!',
    );

    return $mymarkuparray;
  }

}