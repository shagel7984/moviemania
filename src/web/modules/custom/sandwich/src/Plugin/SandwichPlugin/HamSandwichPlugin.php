<?php

namespace Drupal\sandwich\Plugin\SandwichPlugin;
use Drupal\sandwich\Plugin\SandwichPluginBase;


/**
 * Provides a ham sandwich.
 *
 * Because the plugin manager class for our plugins uses annotated class
 * discovery, our meatball sandwich only needs to exist within the
 * Plugin\Sandwich namespace, and provide a Sandwich annotation to be declared
 *  as a plugin. This is defined in
 * \Drupal\plugin_type_example\SandwichPluginManager::__construct().
 *
 * The following is the plugin annotation. This is parsed by Doctrine to make
 * the plugin definition. Any values defined here will be available in the
 * plugin definition.
 *
 * This should be used for metadata that is specifically required to instantiate
 * the plugin, or for example data that might be needed to display a list of all
 * available plugins where the user selects one. This means many plugin
 * annotations can be reduced to a plugin ID, a label and perhaps a description.
 *
 * @SandwichPlugin(
 *   id = "ham_sandwich",
 *   description = @Translation("Ham, mustard, rocket, sun-dried tomatoes."),
 *   calories = 426
 * )
 */
class HamSandwichPlugin extends SandwichPluginBase {

  /**
   * Place an order for a sandwich.
   *
   * This is just an example method on our plugin that we can call to get
   * something back.
   *
   * @param array $extras
   *   Array of extras to include with this order.
   *
   * @return string
   *   A description of the sandwich ordered.
   */
  public function order(array $extras = null) {
    $config = $this->configuration;
    print "<pre>";print_r($config);print "</pre>";

    $ingredients = ['ham, mustard', 'rocket', 'sun-dried tomatoes'];
    if ($extras){
      $sandwich = array_merge($ingredients, $extras);
    }else{
      $sandwich = $ingredients;
    }
    return 'You ordered an ' . $this->pluginDefinition['id'] . " width: " . implode(', ', $sandwich) . ' sandwich. Enjoy!';
  }
}