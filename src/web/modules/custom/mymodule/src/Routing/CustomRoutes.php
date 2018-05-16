<?php
namespace Drupal\mymodule\Routing;

use Symfony\Component\Routing\Route;

class CustomRoutes{

  public function routes(){
    $routes = [];

    $routes['mymodule.mythirdpage'] = new Route(
      '/mymodule/mythird',
      [
        '_controller' => '\Drupal\mymodule\Controller\MyPageController::thirdPage',
        '_title' => 'My third page'
      ],
      [
        '_permission' => 'access content'
      ]
    );

    return $routes;
  }
}