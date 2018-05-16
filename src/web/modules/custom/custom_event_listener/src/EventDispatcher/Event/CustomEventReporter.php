<?php
namespace Drupal\custom_event_listener\EventDispatcher\Event;

use Symfony\Component\EventDispatcher\Event;

class CustomEventReporter extends Event
{


  protected $eventmessage;

  protected $markuparray;

  /**
   * CustomEventReporter constructor.
   * @param $eventmessage
   */
  public function __construct( $eventmessage = NULL, $markuparray = NULL )
  {
    $this->eventmessage = $eventmessage;
    $this->markuparray = $markuparray;
  }

  /**
   * @return mixed
   */
  public function getEventmessage()
  {
    return $this->eventmessage;
  }

  /**
   * @param mixed $eventmessage
   */
  public function setEventmessage($eventmessage): void
  {
    $this->eventmessage = $eventmessage;
  }

  /**
   * @return mixed
   */
  public function getMarkuparray()
  {
    return $this->markuparray;
  }

  /**
   * @param mixed $markuparray
   */
  public function setMarkuparray($markuparray): void
  {
    $this->markuparray = $markuparray;
  }

}