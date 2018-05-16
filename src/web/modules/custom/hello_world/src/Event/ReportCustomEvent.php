<?php

namespace Drupal\hello_world\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Wraps a incident report event for event subscribers.
 *
 * Whenever there is additional contextual data that you want to provide to the
 * event subscribers when dispatching an event you should create a new class
 * that extends \Symfony\Component\EventDispatcher\Event.
 *
 * See \Drupal\Core\Config\ConfigCrudEvent for an example of this in core.
 *
 * @see \Drupal\Core\Config\ConfigCrudEvent
 *
 * @ingroup events_example
 */
class ReportCustomEvent extends Event {

  /**
   * Incident type.
   *
   * @var array
   */
  protected $mymarkuparray;

  /**
   * Constructs an incident report event object.
   *
   * @param array $mymarkuparray
   * The incident report mymarkuparray.
   */
  public function __construct($mymarkuparray) {
    $this->mymarkuparray = $mymarkuparray;
  }

  /**
   * @return array
   */
  public function getMymarkuparray(): array
  {
    return $this->mymarkuparray;
  }


}
