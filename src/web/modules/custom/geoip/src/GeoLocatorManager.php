<?php
namespace Drupal\geoip;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

class GeoLocatorManager extends DefaultPluginManager
{
  protected $defaults = [
    'label' => '',
    'description' => '',
    'weight' => 0
  ];

  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler)
  {
    parent::__construct(
      'Plugin/GeoLocator',
      $namespaces,
      $module_handler,
      'Drupal\geoip\Plugin\GeoLocator\GeoLocatorInterface',
      'Drupal\geoip\Annotation\GeoLocator'
    );

    $this->alterInfo('geolocator_info');
    $this->setCacheBackend($cache_backend,'geolocator_plugins');

  }
}

