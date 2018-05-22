<?php

namespace Drupal\dummymodule\Controller;

use Drupal\Core\Access\AccessManager;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class DummyController extends ControllerBase {

  public function dummyfunction() {

    $url = Url::fromRoute('hello_world');
    $link = Link::fromTextAndUrl('HELLO WORLD LINK', $url);

    /*$accountProxy = \Drupal::currentUser();
    $account = $accountProxy->getAccount();

    $access = new AccessManager();
    $access->checkNamedRoute('hello_world', [], $account);
*/
    $currentUserHasAccess = $url->access();
    $x = 1;

    $buildArray = [
      'buildArray' => [
        '#type' => 'link',
        '#url' => $url,
        '#title' => 'Protected callback'
      ],
    ];

    return $buildArray;
  }

}