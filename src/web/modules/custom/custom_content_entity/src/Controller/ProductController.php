<?php

namespace Drupal\custom_content_entity\Controller;

use Drupal\Core\Controller\ControllerBase;

class ProductController extends ControllerBase {

  public function customfunction()
  {
    $config = \Drupal::entityTypeManager()->getStorage('importer')->load('my_json_product_importer');
    $plugin = \Drupal::service('products.importer_manager')->createInstance($config->getPluginId(),['config' => $config]);
    $plugin->import();

    $mymarkuparray = array(
      '#title' => 'Productimporter !',
      '#markup' => 'Hello from Productimporter!',
    );
    return $mymarkuparray;
  }
}