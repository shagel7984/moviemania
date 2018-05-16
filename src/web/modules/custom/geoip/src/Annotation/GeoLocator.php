<?php
namespace Drupal\geoip\Annotation;

use Drupal\Component\Annotation\Plugin;


/**
 * Class GeoLocator
 * @package Drupal\geoip\Annotation
 *
 * @Annotation
 */

class GeoLocator extends Plugin
{
  /**
   * @var \Drupal\Core\Annotation\Translation
   * @ingroup plugin_translateable
   */
  public $label;

  /**
   * @var \Drupal\Core\Annotation\Translation
   * @ingroup plugin_translateable
   */
  public $description;

}
