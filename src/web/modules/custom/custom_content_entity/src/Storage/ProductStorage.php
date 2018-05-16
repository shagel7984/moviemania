<?php
namespace Drupal\custom_content_entity\Storage;


use Drupal\Core\Entity\Sql\SqlContentEntityStorage;

class ProductStorage extends SqlContentEntityStorage{

  /**
   * Load multiple products by bundle type.
   *
   * @param string $product_type
   * The product type.
   *
   * @return array \Drupal\Core\Entity\EntityInterface[]
   * An array of loaded products entities.
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