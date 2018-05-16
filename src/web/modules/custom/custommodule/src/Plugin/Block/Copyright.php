<?php
/**
 * @file
 * Contains \Drupal\Core\Block\BlockBase
 */
namespace Drupal\custommodule\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use \Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Class Copyright
 * @package Drupal\custommodule\Plugin\Block
 *
 * @Block(
 *  id = "copyright_block",
 *  admin_label = @Translation("Copyright"),
 *  category = @Translation("Custom")
 * )
 */

class Copyright extends BlockBase {

  public function defaultConfiguration()
  {
    return [
      'company_name' => ''
    ];
  }

  public function blockForm($form, FormStateInterface $formState){
    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => t('Company name'),
      '#default_value' => $this->configuration['company_name']
    ];

    return $form;
  }

  function blockSubmit($form, FormStateInterface $form_state)
  {
   $this->configuration['company_name'] = $form_state->getValue('company_name');
  }

  public function build()
  {
    $date = new \DateTime();
    return [
      '#markup' => t('Copyright @year&copy; @company',[
        '@year' => $date->format('Y'),
        '@company' => $this->configuration['company_name']])
    ];
  }


  protected function blockAccess(AccountInterface $account)
  {
    $route_name = \Drupal::routeMatch()->getRouteName();
    if ($account->isAnonymous() && !in_array($route_name, array('user.login','user.logout'))){
      return AccessResult::allowed()->addCacheContexts(['route.name','user.roles:anonymous']);
    }
    return AccessResult::forbidden();
  }
}