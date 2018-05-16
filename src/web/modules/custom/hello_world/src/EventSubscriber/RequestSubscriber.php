<?php
namespace Drupal\hello_world\EventSubscriber;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RequestSubscriber implements EventSubscriberInterface{

  /**
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * @return \Drupal\Core\Routing\AccountProxyInterface
   */
  protected $accountProxy;

  /**
   * @param \Drupal\Core\Session\AccountProxyInterface $route_match
   * @param \Drupal\Core\Session\AccountProxyInterface $account_proxy
   *
   */
  public function __construct(RouteMatchInterface $route_match, AccountProxyInterface $account_proxy)
  {
    $this->routeMatch = $route_match;
    $this->accountProxy = $account_proxy;
  }


  public static function getSubscribedEvents()
  {
    return [
      KernelEvents::REQUEST => ['doAnonymousRedirect',28]
    ];
  }

  public function doAnonymousRedirect(GetResponseEvent $event){
/*
    if($this->routeMatch->getRouteName() == 'user.login'){
      return;
    }

    if($this->accountProxy->isAnonymous()){
      $url = Url::fromRoute('user.login')->toString();
      $redirect = new RedirectResponse($url);

      $event->setResponse($redirect);
    }*/
  }

}