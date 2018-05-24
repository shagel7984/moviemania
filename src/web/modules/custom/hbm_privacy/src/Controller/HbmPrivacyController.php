<?php

namespace Drupal\hbm_privacy\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\hbm_privacy\HbmServices\HbmPrivacyService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class HbmPrivacyController.
 *
 * @package Drupal\hbm_privacy\Controller
 *
 * Provides a function to show the hbm privacy information.
 */
class HbmPrivacyController extends ControllerBase {

  /**
   * The Drupal\hbm_privacy\HbmServices\HbmPrivacyService.
   *
   * @var Drupal\hbm_privacy\HbmServices\HbmPrivacyService
   */
  private $hbmPrivacyService;

  /**
   * HbmPrivacyController constructor.
   *
   * @param Drupal\hbm_privacy\HbmServices\HbmPrivacyService $hbmPrivacyService
   *   The HbmPrivacyService.
   */
  public function __construct(HbmPrivacyService $hbmPrivacyService) {
    $this->hbmPrivacyService = $hbmPrivacyService;
  }

  /**
   * Function to show the hbm privacy information.
   *
   * @return array
   *   Returns a render array.
   */
  public function showHbmPrivacy() {

    $privacyContent = $this->hbmPrivacyService->providePrivacyData();

    if (isset($privacyContent['success']) && $privacyContent['success']) {
      $build = [
        '#theme' => 'hbm_privacy',
        '#hbm_privacy' => $privacyContent['content'],
      ];

      $noindex = [
        '#tag' => 'meta',
        '#attributes' => [
          'name' => 'robots',
          'content' => 'noindex,follow',
        ],
      ];

      $build['#attached']['html_head'][] = [$noindex, 'noindex'];

      return $build;
    }
    else {
      throw new NotFoundHttpException();
    }

  }

  /**
   * Function create().
   *
   * @inheritdoc
   */
  public static function create(ContainerInterface $container) {
    $hbmPrivacyService = $container->get('hbm_privacy.hbmprivacyservice');
    return new static($hbmPrivacyService);
  }

}
