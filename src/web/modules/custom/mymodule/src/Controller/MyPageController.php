<?php

/*
 * @file
 * Contains \Drupal\mymodule\Controller\MyPageController class
 */

namespace Drupal\mymodule\Controller;


use Drupal\Core\Controller\ControllerBase;


class MyPageController extends ControllerBase{
  /*
   * Return the markup of custom page
   */


  public function customPage(){

    if (\Drupal::currentUser()->hasPermission('view module pages')){
      return [
        '#markup' => t('Welcome to my CUSTOM page! Congrats you have permission')
      ];
    }else{
      return [
        '#markup' => t('Welcome to my CUSTOM page!')
      ];
    }
  }

  public function secondPage($name = null){

    if ($name){
      return [
        '#markup' => t('Hey @name Welcome to my SECOND page!',['@name' => $name])
      ];
    }else{
      return [
        '#markup' => t('Welcome to my SECOND page!')
      ];
    }

  }

  public function thirdPage(){
    return [
      '#markup' => t('Welcome to my third page!')
    ];
  }

}