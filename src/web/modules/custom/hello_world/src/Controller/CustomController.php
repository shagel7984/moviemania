<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessResultInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\hello_world\Services\GoodbyeService;
use Drupal\hello_world\Services\HelloService;
use Drupal\kint\Plugin\Devel\Dumper\Kint;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CustomController extends ControllerBase {

  private $helloService;
  private $goodbyeService;
  private $loggerFactoryService;

  public function __construct(HelloService $helloService, GoodbyeService $goodbyeService, LoggerChannelFactoryInterface $loggerFactoryService)
  {
    $this->helloService = $helloService;
    $this->goodbyeService = $goodbyeService;
    $this->loggerFactoryService = $loggerFactoryService;
  }

  public function customfunction() {
    //$service = \Drupal::service('hello_world.say_hello');
    //dsm($service);
    //dsm($service->sayHello('sebastian'));

    //dsm($this->helloService);
    //dsm($this->goodbyeService);
    //dsm($this->helloService->sayHello('sebastian'));
    //dsm($this->helloService->sayGoodbye('sebastian'));
    //dsm($this->helloService->sayHello('sebastian'));
    //dsm($this->goodbyeService->sayGoodbye('sebastian'));
    $resp = $this->helloService->sayHello('sebastian');
    $this->loggerFactoryService->get('')->debug($resp);

    //$config1 = \Drupal::config('custom_config_entity.myconfigentity.my_custom_config_entity');
    //print "CONFIG 1".$config1->get('label');echo "<br/>";
    //$config2 =  \Drupal::entityTypeManager()->getStorage('myconfigentity')->load('my_custom_config_entity');
    //print "CONFIG 2".$config2->get('label');echo "<br/>";


   /* $mymarkuparray = array(
      '#title' => 'Hello World!',
      '#markup' => 'Here is some content.',
    );

    $module_handler = \Drupal::moduleHandler();
    $module_handler->invokeAll('hello_world_changecontent',array(&$mymarkuparray));

    return $mymarkuparray;*/

    $mymarkuparray = [
      'test1' => [
        '#title' => 'Hello Clock',
        '#markup' => '<div class="salutation">Salutation</div>',
      ],
      'test2' => [
        '#title' => 'Hello World!',
        '#markup' => 'Here is some content. *',
      ],
      'test3' =>[
        '#attached' =>  [
          'drupalSettings' => [
            'hello_world' => [
              'hello_world_clock' => [
                'afternoon' => 'testmeifyoucan'
              ]
            ]
          ],
          /*'library' => [
            'moviemania/hello_world_clock'
          ]*/
        ]
      ]
    ];

    return $mymarkuparray;
  }

  public static function create(ContainerInterface $container)
  {
    $helloService = $container->get('hello_world.say_hello');
    $goodbyeService = $container->get('hello_world.say_goodbye');
    $loggerFactoryService = $container->get('logger.factory');
    return new static($helloService,$goodbyeService,$loggerFactoryService);
  }

  /**
   * Checks access for this controller.
   */
  public function access() {
    // Don’t allow access before Friday, November 25, 2016.
    /*$today = date("Y-m-d H:i:s");
    $date = "2016-11-25 00:00:00";
    if ($date < $today) {
      // Return 403 Access Denied page.
      return AccessResult::forbidden();
    }*/
    //return AccessResult::forbidden();
    return AccessResult::allowed();
  }

}