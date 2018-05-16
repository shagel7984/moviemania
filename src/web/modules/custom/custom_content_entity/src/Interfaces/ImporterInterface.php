<?php
namespace Drupal\custom_content_entity\Interfaces;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface ImporterInterface extends ConfigEntityInterface{

  /**
   * @return Url
   */
  public function getUrl();

  /**
   * @return string
   */
  public function getPluginId();

  /**
   * @return bool
   */
  public function updateExisting();

  /**
   * @return string
   */
  public function getSource();

  /**
   * Returns the Product type that needs to be created.
   *
   * @return string
   */
  public function getBundle();

}