<?php

namespace Drupal\custom_event_listener\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\custom_event_listener\EventDispatcher\Event\CustomEventReporter;
use Drupal\custom_event_listener\EventDispatcher\Event\CustomEvents;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class CustomController extends ControllerBase {

  /**
   * The event dispatcher service.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $event_dispatcher;

  /**
   * Constructs a new UserLoginForm.
   *
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   *   The event dispatcher service.
   */
  public function __construct(EventDispatcherInterface $event_dispatcher) {
    // The event dispatcher service is an implementation of
    // \Symfony\Component\EventDispatcher\EventDispatcherInterface. In Drupal
    // this is generally and instance of the
    // \Drupal\Component\EventDispatcher\ContainerAwareEventDispatcher service.
    // This dispatcher improves performance when dispatching events by compiling
    // a list of subscribers into the service container so that they do not need
    // to be looked up every time.
    $this->event_dispatcher = $event_dispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_dispatcher')
    );
  }

  /**
   * @return array
   */
  public function customfunction() {
    $eventmessage = "Hello from my custom event dispatcher. Congratulations!";

    $mymarkuparray = array(
      '#title' => 'EventSubscriber!',
      '#markup' => 'Here is some content!',
    );



    /** @var CustomEventReporter $event */
    $event = new CustomEventReporter($eventmessage,$mymarkuparray);
    $eventResponse = $this->event_dispatcher->dispatch(CustomEvents::MY_CUSTOM_EVENT, $event );

    if ($eventResponse->getMarkuparray()){
      $mymarkuparray = $eventResponse->getMarkuparray();
    }

    return $mymarkuparray;

  }

}