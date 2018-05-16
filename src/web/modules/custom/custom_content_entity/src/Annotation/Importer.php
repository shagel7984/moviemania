<?php
namespace Drupal\custom_content_entity\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Class Importer
 * @package Drupal\custom_content_entity\Annotation
 * Defines a Importer item annotation object
 *
 * @see \Drupal\custom_content_entity\Plugin\ImporterManager
 *
 * @Annotation
 */

class Importer extends Plugin{

  /**
   * @var string
   */
  public $id;

  /**
   * @var \Drupal\Core\Annotation\Translation
   * @ingroup plugin_translatable
   *
   */
  public $label;

}