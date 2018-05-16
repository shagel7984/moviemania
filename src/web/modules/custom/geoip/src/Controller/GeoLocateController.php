<?php
namespace Drupal\geoip\Controller;


use Drupal\Core\Controller\ControllerBase;

class GeoLocateController extends ControllerBase{

  public function geoLocate(){
    $geolocator_manager = \Drupal::service('plugin.manager.geolocator');
    $cdn_instance = $geolocator_manager->createInstance('cdn');
    $country_code = $cdn_instance->geolocate('127.0.0.1');

    $msg = array(
      '#title' => 'Hello from Geolocator',
      '#markup' => "Country code: ".$country_code,
    );

return $msg;

  }

}