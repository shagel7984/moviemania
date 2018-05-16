<?php

namespace Drupal\custommodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomMessageController extends ControllerBase {

  public function __construct()
  {
  }

  public function customfunction()
  {
    $Allsimple = \Drupal::entityTypeManager()->getStorage('message_type')->loadMultipleByType('message_type');
    var_dump($Allsimple);

    die();


    $mymarkuparray = array(
      '#title' => 'Hello from Custommodule!',
      '#markup' => 'Here is some content!',
    );

    return $mymarkuparray;
  }

}