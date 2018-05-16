<?php
namespace Drupal\simple\Storage;


use Drupal\Core\Config\Entity\ConfigEntityStorage;

class SimpleTypeStorage extends ConfigEntityStorage{

  /**
   * Load multiple simple by bundle type.
   *
   * @param string $simple_type
   * The simple type.
   *
   * @return array \Drupal\Core\Entity\EntityInterface[]
   * An array of loaded simple entities.
   *
   */
  public function loadMultipleByType($simple_type){
    return $this->loadByProperties(
      [
      'bundle' => $simple_type
      ]
    );
  }

}