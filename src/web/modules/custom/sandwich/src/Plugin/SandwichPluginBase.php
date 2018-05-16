<?php

namespace Drupal\sandwich\Plugin;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Sandwich plugin plugins.
 */
abstract class SandwichPluginBase extends PluginBase implements SandwichPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function description() {
    // Retrieve the @description property from the annotation and return it.
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function calories() {
    // Retrieve the @calories property from the annotation and return it.
    return (float) $this->pluginDefinition['calories'];
  }

  /**
   * {@inheritdoc}
   */
  abstract public function order(array $extras = NULL);

}
