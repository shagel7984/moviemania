<?php

/**
 * @file
 * Contains custom_ce.page.inc.
 *
 * Page callback for Custom ce entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Custom ce templates.
 *
 * Default template: custom_ce.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_custom_ce(array &$variables) {
  // Fetch CustomCe Entity Object.
  $custom_ce = $variables['elements']['#custom_ce'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
