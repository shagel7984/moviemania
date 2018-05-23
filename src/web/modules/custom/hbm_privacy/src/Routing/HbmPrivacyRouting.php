<?php

namespace Drupal\hbm_privacy\Routing;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class HbmPrivacyRouting.
 *
 * @package Drupal\hbm_privacy\Routing
 */
class HbmPrivacyRouting {

  /**
   * {@inheritdoc}
   */
  public function routes() {

    $hbmPrivacyConfig = \Drupal::config('hbm_privacy.settings');
    $hbmPrivacyPageLink = $hbmPrivacyConfig->get('privacy_page_link');

    if ($hbmPrivacyPageLink) {
      $route_collection = new RouteCollection();

      $route = new Route(
        // Path to attach this route to:
        '/' . $hbmPrivacyPageLink,
        // Route defaults:
        [
          '_controller' => '\Drupal\hbm_privacy\Controller\HbmPrivacyController::showHbmPrivacy',
        ],
        // Route requirements:
        [
          '_permission'  => 'access content',
        ]
      );

      $route_collection->add('hbm_privacy.route', $route);

      return $route_collection;
    }
  }

}
