<?php

namespace Drupal\customce\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Custom ce entities.
 */
class CustomCeViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
