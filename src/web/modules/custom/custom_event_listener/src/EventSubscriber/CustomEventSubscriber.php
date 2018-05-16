<?php
namespace Drupal\custom_event_listener\EventSubscriber;

use Drupal\custom_event_listener\EventDispatcher\Event\CustomEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CustomEventSubscriber implements EventSubscriberInterface
{


  /**
   * Returns an array of event names this subscriber wants to listen to.
   *
   * The array keys are event names and the value can be:
   *
   *  * The method name to call (priority defaults to 0)
   *  * An array composed of the method name to call and the priority
   *  * An array of arrays composed of the method names to call and respective
   *    priorities, or 0 if unset
   *
   * For instance:
   *
   *  * array('eventName' => 'methodName')
   *  * array('eventName' => array('methodName', $priority))
   *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
   *
   * @return array The event names to listen to
   */
  public static function getSubscribedEvents()
  {
    $events[CustomEvents::MY_CUSTOM_EVENT][] = ['generateWebsiteNotification'];
    $events[CustomEvents::MY_CUSTOM_EVENT][] = ['manipulateContent'];
    return $events;
  }

  public function generateWebsiteNotification($event){
    $eventmessage = $event->getEventmessage();
    if ($eventmessage){
      drupal_set_message(t('generateWebsiteNotification: @eventmessage',['@eventmessage' => $eventmessage] ),'status');
    }
  }

  public function manipulateContent($event){
    $markuparray = $event->getMarkuparray();
    if (!empty($markuparray)){
      $markuparray['#markup'] = 'Here is some manipulated content';
      $event->setMarkuparray($markuparray);
    }
  }
}