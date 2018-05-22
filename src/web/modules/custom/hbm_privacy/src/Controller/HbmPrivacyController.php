<?php
namespace Drupal\hbm_privacy\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\hbm_privacy\HbmServices\HbmPrivacyService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class HbmPrivacyController
 * @package Drupal\hbm_privacy\Controller
 * provides a function to show the hbm privacy information
 */
class HbmPrivacyController extends ControllerBase {
  /**
   * @var HbmPrivacyService
   */
  private $hbmPrivacyService;

  /**
   * HbmPrivacyController constructor.
   * @param HbmPrivacyService $hbmPrivacyService
   */
  public function __construct(HbmPrivacyService $hbmPrivacyService){
    $this->hbmPrivacyService = $hbmPrivacyService;
  }

  /**
   * @return array
   * function to show the hbm privacy information
   */
  public function showHbmPrivacy() {
    $hbmPrivacy = $this->hbmPrivacyService->providePrivacyData();

    $build = [
      '#theme' => 'hbm_privacy',
      '#hbm_privacy' => $hbmPrivacy,
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

  /**
   * @param ContainerInterface $container
   * @return static
   */
  public static function create(ContainerInterface $container){
    $hbmPrivacyService = $container->get('hbm_privacy.hbmprivacyservice');
    return new static($hbmPrivacyService);
  }

}