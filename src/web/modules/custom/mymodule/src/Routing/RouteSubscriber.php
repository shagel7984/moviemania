<?php
namespace Drupal\mymodule\Routing;


use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RouteSubscriber extends RouteSubscriberBase{

  /**
   * Alters existing routes for a specific collection.
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   The route collection for adding routes.
   */
  protected function alterRoutes(RouteCollection $collection)
  {

   /*if ($route = $collection->get('mymodule.myfirstpage')){
      $route->setPath('/mymodule/my-page');
    }*/
  }
}