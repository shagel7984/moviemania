<?php

namespace Drupal\hello_world\Controller;

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


    $config1 = \Drupal::config('custom_config_entity.myconfigentity.my_custom_config_entity');
    //print "CONFIG 1".$config1->get('label');echo "<br/>";
    $config2 =  \Drupal::entityTypeManager()->getStorage('myconfigentity')->load('my_custom_config_entity');
    //print "CONFIG 2".$config2->get('label');echo "<br/>";


    $mymarkuparray = array(
      '#title' => 'Hello World!',
      '#markup' => 'Here is some content.',
    );

    $module_handler = \Drupal::moduleHandler();
    $module_handler->invokeAll('hello_world_changecontent',array(&$mymarkuparray));

    return $mymarkuparray;

  }

  public static function create(ContainerInterface $container)
  {
    $helloService = $container->get('hello_world.say_hello');
    $goodbyeService = $container->get('hello_world.say_goodbye');
    $loggerFactoryService = $container->get('logger.factory');
    return new static($helloService,$goodbyeService,$loggerFactoryService);
  }


}