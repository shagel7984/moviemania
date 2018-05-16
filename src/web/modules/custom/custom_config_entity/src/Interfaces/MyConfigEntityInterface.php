<?php
namespace Drupal\custom_config_entity\Interfaces;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface MyConfigEntityInterface extends ConfigEntityInterface{

  /**
   * Gets the floppy value
   * @return boolean
   */
  public function getFloppy();

}