<?php
namespace Drupal\geoip\Plugin\GeoLocator;

interface GeoLocatorInterface
{
  public function label();

  public function description();

  public function geolocate($ip_address);
}