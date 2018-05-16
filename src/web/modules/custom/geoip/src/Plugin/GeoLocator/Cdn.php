<?php
/**
 * Created by PhpStorm.
 * User: d427545
 * Date: 10.04.18
 * Time: 09:45
 */

namespace Drupal\geoip\Plugin\GeoLocator;


use Drupal\Core\Plugin\PluginBase;

/**
 *
 * @GeoLocator(
 *   id = "cdn",
 *   label = "CDN",
 *   description = "Checks for geolocation headers send by CDN services",
 *   weight = -10
 * )
 *
 */

class Cdn extends PluginBase implements GeoLocatorInterface
{

  public function label()
  {
    return $this->pluginDefinition['label'];
  }

  public function description()
  {
    return $this->pluginDefinition['description'];
  }

  public function geolocate($ip_address)
  {
    if(!empty($_SERVER['HTTP_CF_IPCOUNTRY'])){
      $countryCode = $_SERVER['HTTP_CF_IPCOUNTRY'];
    }
    elseif (!empty($_SERVER['HTTP_CLOUDFRONT_VIEWER_COUNTRY'])){
      $country_code = $_SERVER['HTTP_CLOUDFRONT_VIEWER_COUNTRY'];
    }
    else{
      $country_code = NULL;
    }

    return $country_code."Cloudflare index HTTP_CF_IPCOUNTRY not set";
  }
}