<?php
namespace Drupal\hello_world\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;

/**
 * Class CustomAccessCheck.
 *
 * @package Drupal\hello_world\Access
 */
class CustomAccessCheck implements AccessInterface {

  /**
   * A custom access check.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Run access checks for the logged in user.
   */
  public function access(AccountInterface $account) {

    $url = Url::fromRoute('hello_world.hello');
    if($url->access()){
      //Do something.

    }

    // User has a profile field defining their favorite color.
    /*if ($account->field_color->hasField() && !$account->field_color->isEmpty() && $account->field_color->getString() === 'blue') {
      // If the user's favorite color is blue, give them access.
      return AccessResult::allowed();
    }*/

    //return AccessResult::forbidden();
    return AccessResult::allowed();
  }

}