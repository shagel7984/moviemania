<?php

namespace Drupal\hello_world\Controller;

use Drupal\hello_world\Event\CustomEvents;
use Drupal\hello_world\Event\ReportCustomEvent;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;



class HelloWorldController {

  /*
  public function __construct(EventDispatcherInterface $event_dispatcher) {
    $this->eventDispatcher = $event_dispatcher;
  }*/

/*
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_dispatcher')
    );
  }
*/
  public function hello() {
    $service = \Drupal::service('hello_world.say_hello');


    //dsm($service);
    //dsm($service->sayHello('sebastian'));

    //$breadcrumbService = \Drupal::service('hello_world.breadcrumb');
    //dsm($breadcrumbService);
    //dsm($breadcrumbService->build());

    /*
    return array(
      '#title' => 'Hello World!',
      '#markup' => 'Here is some content.',
    );
*/
    $mymarkuparray = array(
      '#title' => 'Hello World!',
      '#markup' => 'Here is some content!',
    );
/*
    $mymarkuparray = [
      'test1' => [
        '#type' => 'view',
        '#name' => 'movie news',
        '#display_id' => 'embed_1'
      ],
      'test2' => [
        '#title' => 'Hello World!',
        '#markup' => 'Here is some content. *',
      ]
    ];
*/
    //$dispatcher = \Drupal::service('event_dispatcher');
    //$dispatcher->dispatch('hello_world.changecontent',array(&$mymarkuparray));

    //$event = new ReportCustomEvent($mymarkuparray);
    //$this->eventDispatcher->dispatch(CustomEvents::CHANGECONTENT,$event);

    $module_handler = \Drupal::moduleHandler();
    $module_handler->invokeAll('hello_world_changecontent',array(&$mymarkuparray));

    return $mymarkuparray;

  }
}