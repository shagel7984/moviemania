<?php
namespace Drupal\custom_content_entity\Storage;


use Drupal\Core\Config\Entity\ConfigEntityStorage;

class ProductTypeStorage extends ConfigEntityStorage{

  /**
   * Load multiple messages by bundle type.
   *
   * @param string $product_type
   * The message type.
   *
   * @return array \Drupal\Core\Entity\EntityInterface[]
   * An array of loaded producttypes entities.
   *
   */
  public function loadMultipleByType($product_type){
    return $this->loadByProperties(
      [
        'bundle' => $product_type
      ]
    );
  }

}