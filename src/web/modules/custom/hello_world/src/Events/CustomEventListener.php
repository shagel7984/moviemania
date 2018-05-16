<?php
namespace Drupal\hello_world\Events;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class CustomEventListener implements EventSubscriberInterface{

  public function onKernelRequest($event){
    //var_dump($event);
    //die();
  }

  public static function getSubscribedEvents()
  {
    return [
      KernelEvents::REQUEST => 'onKernelRequest',
    ];
  }

}